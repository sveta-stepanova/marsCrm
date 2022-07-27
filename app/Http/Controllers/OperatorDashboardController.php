<?php

namespace App\Http\Controllers;

use App\Http\Requests\BreederResponseRequest;
use App\Http\Requests\ResponseSearchRequest;
use App\Models\AspNetUser;
use App\Models\Breed;
use App\Models\Form;
use App\Models\Response;
use App\Models\Setting;
use App\Models\Staff;
use App\Models\FormState;
use App\Models\Breeder;
use App\Models\Email;
use App\Models\BreederNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class OperatorDashboardController extends Controller {

    /** @var Staff */
    private $operator;

    public function __construct() {
        $this->middleware(function($request, $next) {
            /** @var AspNetUser $user */
            $user = Auth::user();
            $this->operator = $user->staff()->first();
            return $next($request);
        });
    }

    public function index() {
        return view('oper.index', [
            'toBeProcessed' => Form::toBeProcessed($this->operator)->count(),
            'wrapId' => 'auth'
        ]);
    }

    public function checkoutForm() {
        /** @var Form $nextForm */
        $nextForm = Form::toBeProcessed($this->operator)->first();
        if (!$nextForm) {
            return redirect()->route('oper-dashboard');
        }
        $nextForm->checkout($this->operator);
        return redirect('/oper/form/' . $nextForm->Id);
    }

    public function editForm($id) {
        /** @var Form $form */
        $form = Form::find($id);

        if (!$form->isCheckedOut($this->operator)) {
            return redirect()->route('oper-dashboard');
        }
        $settings = Setting::first();
        if ($settings->BreederBreedsOnlyInForms) {
            $breeds = $form->breeder->breeds;
        } else {
            $breeds = Breed::orderBy('Name')->get();
        }

        return view('oper.edit-form', [
            'form' => $form,
            'bodyId' => 'edit-form',
            'breeds' => $breeds,
            'statusList' => FormState::where(['SetManually' => 1])->get(),
        ]);
    }

    public function formImage($id) {
        $form = Form::find($id);
        return Image::make($form->imageFileName())->response();
    }

    public function saveResponse(BreederResponseRequest $request, $formId, $responseId = null) {
        $form = Form::findOrFail($formId);
        $breeder = Breeder::where('Id',$form->BreederId)->first();
        $formState = FormState::where('Id', $form->FormStateId)->first();
        if ($responseId) {
            $response = $form->responses()->findOrFail($responseId);
        } else {
            if ($form->responses()->where(['Phone' => $request->Phone, 'PetName' => $request->PetName])->count()) {
                $response = $form->responses()->where(['Phone' => $request->Phone, 'PetName' => $request->PetName])->first();
            } else {
                $response = new Response();
            }
        }
        $response->updateFromRequest($request);
        $response->FormId = $form->Id;
        $response->CreatedBy = $this->operator->Id;
        $response->save();
        
        if(!$response->Valid) {
            if (isset($breeder->manager->Email)) {
                
            \App\Services\Mail::responseNvalidManagerSend($breeder->manager->Email, "Анкета по заказу №" . $form->order->OrderId . " от " . $form->order->CreatedAt . " Признана не валидной",
                    $response, $breeder, $form->order->OrderId, $formState);
                
            $emailS = Email::create([
                        'EmailFrom' => 'noreply@response.ru',
                        'NameFrom' => 'PERFECT FIT',
                        'EmailTo' => $breeder->manager->Email,
                        'Subject' => "Анкета по заказу №" . $form->order->OrderId . " от " . $form->order->CreatedAt . " Признана не валидной",
                        'Text' => view('emails.responseNvalidManager', ['response' => $response,'breeder' => $breeder, 
                            'orderId' => $form->order->OrderId, 'formState' => $formState]),
                        'SendDate' => Carbon::now(),
                        'CreatedBy' => Auth::user()->Email
            ]);
        }
        \App\Services\Mail::responseNvalidSend($breeder->aspNetUser->Email, "Анкета по заказу №" . $form->order->OrderId . " от " . $form->order->CreatedAt . " Признана не валидной",
                    $response, $breeder, $form->order->OrderId, $formState);
        $email = Email::create([
                    'EmailFrom' => 'noreply@response.ru',
                    'NameFrom' => 'PERFECT FIT',
                    'EmailTo' => $breeder->aspNetUser->Email,
                    'Subject' => "Анкета по заказу №" . $form->order->OrderId . " от " . $form->order->CreatedAt . ' Признана не валидной',
                    'Text' => view('emails.responseNvalid', ['response' => $response, 'breeder' => $breeder, 'orderId' => $form->order->OrderId, 'formState' => $formState]),
                    'SendDate' => Carbon::now(),
                    'CreatedBy' => Auth::user()->Email
        ]);
        
        BreederNotification::create([
            'Subject' => "Анкета по заказу №" . $form->order->OrderId . " от " . $form->order->CreatedAt . ' Признана не валидной',
            'BreederId' => $breeder->Id
        ]);
        }
        return response()->json($response);
    }

    public function listResponses($formId) {
        $form = Form::findOrFail($formId);
        $this->checkCheckout($form);
        return response()->json(['responses' => $form->responses]);
    }

    public function getResponse($formId, $responseId) {
        $form = Form::findOrFail($formId);
        $this->checkCheckout($form);
        $response = $form->responses()->findOrFail($responseId);
        return response()->json(['response' => $response]);
    }

    public function setFormStatus($formId, Request $request) {
        $form = Form::findOrFail($formId);
        $breeder = Breeder::where('Id',$form->BreederId)->first();
        $formState = FormState::where('Id', $request->StatusId)->first();
        $this->checkCheckout($form);
        $form->FormStateId = $request->StatusId;
        $form->ValidatedAt = Carbon::now();
        $form->ValidatedBy = $this->operator->Id;
        $form->save();
        
        if (isset($breeder->manager->Email)) {
            \App\Services\Mail::formNvalidManagerSend($breeder->manager->Email, "Анкета по заказу №" . $form->order->OrderId . " от " . $form->order->CreatedAt . " Признана не валидной",
                    $breeder, $form->order->OrderId, $formState);
            
            $emailS = Email::create([
                        'EmailFrom' => 'noreply@response.ru',
                        'NameFrom' => 'PERFECT FIT',
                        'EmailTo' => $breeder->manager->Email,
                        'Subject' => "Анкета по заказу №" . $form->order->OrderId . " от " . $form->order->CreatedAt . ' Признана не валидной',
                        'Text' => view('emails.formNvalidManager', ['breeder' => $breeder, 'orderId' => $form->order->OrderId, 'formState' => $formState]),
                        'SendDate' => Carbon::now(),
                        'CreatedBy' => Auth::user()->Email
            ]);
        }
        \App\Services\Mail::formNvalidSend($breeder->aspNetUser->Email, "Анкета по заказу №" . $form->order->OrderId . " от " . $form->order->CreatedAt . " Признана не валидной",
                    $breeder, $form->order->OrderId, $formState);
        $email = Email::create([
                    'EmailFrom' => 'noreply@response.ru',
                    'NameFrom' => 'PERFECT FIT',
                    'EmailTo' => $breeder->aspNetUser->Email,
                    'Subject' => "Анкета по заказу №" . $form->order->OrderId . " от " . $form->order->CreatedAt . ' Признана не валидной',
                    'Text' => view('emails.formNvalid', ['breeder' => $breeder, 'orderId' => $form->order->OrderId, 'formState' => $formState]),
                    'SendDate' => Carbon::now(),
                    'CreatedBy' => Auth::user()->Email
        ]);
        
        BreederNotification::create([
            'Subject' => "Анкета по заказу №" . $form->order->OrderId . " от " . $form->order->CreatedAt . ' Признана не валидной',
            'BreederId' => $breeder->Id,
            'Text' => 'Причина невалидности: '. $formState->Name.'. <br>'.$formState->Description,
        ]);
        
        return response()->json(['form' => $form]);
    }

    public function finishForm($formId) {
        $form = Form::findOrFail($formId);
        $this->checkCheckout($form);
        if (!$form->responses()->count()) {
            throw new \Exception('No responses found ("finish" button should not be rendered on FE)');
        }
        $form->FormStateId = FormState::STATUS_ID_VALID;
        $form->ValidatedBy = $this->operator->Id;
        $form->ValidatedAt = Carbon::now();
        $form->save();
        return response()->json(['form' => $form]);
    }

    private function checkCheckout(Form $form) {
        if (!$form->isCheckedOut($this->operator)) {
            throw new \Exception('Not checked out by current operator');
        }
    }

    public function search($formId, ResponseSearchRequest $request) {
        $form = Form::find($formId);
        $this->checkCheckout($form);

        if (!$request->Phone && !$request->Email && !$request->LastName) {
            return response()->json(['responses' => []]);
        }

        $respQuery = Response::select();
        if ($request->FirstName) {
            $respQuery->where('FirstName', 'LIKE', $request->FirstName . '%');
        }
        if ($request->LastName) {
            $respQuery->where('LastName', 'LIKE', $request->LastName . '%');
        }
        if ($request->Phone) {
            $respQuery->where(['Phone' => $request->Phone]);
        }
        if ($request->Email) {
            $respQuery->where('Email', 'LIKE', $request->Email . '%');
        }

        return response()->json(['responses' => $respQuery->get()]);
    }

}
