<?php

namespace App\Http\Controllers;

use App\Brands\PerfectFit;
use App\Brand;
use App\Http\Requests\BreederUpdateRequest;
use App\Http\Requests\BreederPersonalRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\PasswordRequest;
use App\Services\Auth as Service;
use App\Models\Breed;
use App\Models\Product;
use App\Models\Order;
use App\Models\Form;
use App\Models\Breeder;
use App\Models\AspNetUser;
use App\Models\AspNetRole;
use App\Models\AspNetUserRole;
use App\Models\BreederBreed;
use App\Models\Fias;
use App\Models\Email;
use App\Models\RegionDealer;
use App\Models\BreederNotification;
use App\Models\BreederSupport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Intervention\Image\Facades\Image;

class BreederCabinetController extends Controller {

    public function index(Request $request) {
        $breeder = Auth::user()->breeders()->first();
        $breederBreeds = $breeder->breederBreeds()->get();
//        $birthDate = Carbon::parse($breeder->BirthDate)->format('d.m.Y');
        return view('cabinet.index', [
            'user' => Auth::user(),
            'breeder' => Auth::user()->breeders()->first(),
            'breederBreeds' => $breederBreeds,
//            'birthDate' => $birthDate,
            'region' => Fias::find($breeder->NurseryRegionId),
            'city' => Fias::find($breeder->NurseryCityId),
            'regions' => Fias::regions()->get()
        ]);
    }

    public function edit(BreederPersonalRequest $request) {
        $breeder = Auth::user()->breeders()->first();
        $user = AspNetUser::find(Auth::id());
        $breeder->Phone = clearPhone($request->Phone);
        $user->Email = $request->Email;
        $user->UserName = $request->Email;
        $breeder->save();
        $user->save();

        return redirect('/cabinet');
    }

    public function nursery(Request $request) {
        $breeder = Auth::user()->breeders()->first();
        $breederBreeds = $breeder->breederBreeds()->get();

        return view('cabinet.nursery', [
            'user' => Auth::user(),
            'breeder' => $breeder,
            'breederBreeds' => $breederBreeds,
            'region' => Fias::find($breeder->NurseryRegionId),
            'city' => Fias::find($breeder->NurseryCityId)
        ]);
    }

    public function orders(Request $request) {
        $breeder = Auth::user()->breeders()->first();
        $breederBreeds = $breeder->breederBreeds()->get();
        $orders = $breeder->orders()->get();
        foreach ($orders as $order) {
            $breedSize = $order->breederBreed()->first()->breed->breedSize;
            $responses = $breeder
                    ->join('Forms', 'BreederId', '=', 'Breeders.Id')
                    ->join('Responses', 'Responses.FormId', '=', 'Forms.Id')
                    ->where('Forms.OrderId', $order->Id);
            $order->responsesValid = (clone $responses)->where('Valid', 1)->count();
            $order->responsesUnvalid = (clone $responses)->where('Valid', 0)->count();
            $order->product = (new Product())->getProductForSize($breedSize->Mnemonic)->Name;
        }
        return view('cabinet.orders', [
            'orders' => $orders,
            'user' => Auth::user(),
            'breeder' => $breeder,
            'breederBreeds' => $breederBreeds,
            'limit' => $breeder->limitPetCount() // расчетное число
        ]);
    }

    public function ordersHistory(Request $request) {
        $breeder = Auth::user()->breeders()->first();
        $orders = $breeder->orders()->orderBy('CreatedAt')->get();
        foreach ($orders as $order) {
            $breedSize = $order->breederBreed()->first()->breed->breedSize;
            $responses = $breeder
                    ->join('Forms', 'BreederId', '=', 'Breeders.Id')
                    ->join('Responses', 'Responses.FormId', '=', 'Forms.Id')
                    ->where('Forms.OrderId', $order->Id);
            $order->responsesValid = (clone $responses)->where('Valid', 1)->count();
            $order->responsesUnvalid = (clone $responses)->where('Valid', 0)->count();
            $order->product = (new Product())->getProductForSize($breedSize->Mnemonic)->Name;
        }
        return view('cabinet.ordersHistory', [
            'orders' => $orders
        ]);
    }

    public function orderProcessing(OrderRequest $request) {

        $breeder = Auth::user()->breeders()->first();
        $breederBreed = $breeder->breederBreeds()->where('Id', $request->BreederBreedId)->first();
        $breedSize = $breederBreed->breed->breedSize;
        $deliveryDate = (new Order())->orderDeliveryDate($request->LitterDate)->format('Y-m-d');
        $product = (new Product())->getProductForSize($breedSize->Mnemonic)->Name;
        $packageCount = (new Order)->orderPackageCount($breedSize->Mnemonic) * $request->PetCount;

        $order = Order::create([
                    'BreederId' => $breeder->Id,
                    'BreederBreedId' => $breederBreed->Id,
                    'PetCount' => $request->PetCount,
                    'PrizeCount' => $request->PetCount,
                    'LitterDate' => $request->LitterDate,
                    'SupplyDate' => $deliveryDate,
                    'DrySmallCount' => in_array($breedSize->Mnemonic, ['XS', 'S']) ? $packageCount : 0,
                    'DryLargeCount' => in_array($breedSize->Mnemonic, ['M', 'L', 'XL']) ? $packageCount : 0,
                    'PetBreed' => $breederBreed->breed->Name
        ]);

        $orderID = Order::find($order->Id)->OrderId;
        if (isset($breeder->manager->Email)) {

            \App\Services\Mail::SendOrderManagerMail($breeder->manager->Email, "Заказ №" . $orderID . " от " . $order->CreatedAt, $breeder, $order);

            $emailS = Email::create([
                        'EmailFrom' => 'noreply@response.ru',
                        'NameFrom' => 'PERFECT FIT',
                        'EmailTo' => $breeder->manager->Email,
                        'Subject' => "Заказ №" . $orderID . " от " . $order->CreatedAt,
                        'Text' => view('emails.orderManager', ['breeder' => $breeder, 'order' => $order]),
                        'SendDate' => Carbon::now(),
                        'CreatedBy' => Auth::user()->Email
            ]);
        }

        \App\Services\Mail::SendOrderMail(Auth::user()->Email, "Заказ №" . $orderID . " от " . $order->CreatedAt, $breeder, $order);

        $email = Email::create([
                    'EmailFrom' => 'noreply@response.ru',
                    'NameFrom' => 'PERFECT FIT',
                    'EmailTo' => Auth::user()->Email,
                    'Subject' => "Заказ №" . $orderID . " от " . $order->CreatedAt,
                    'Text' => view('emails.order', ['breeder' => $breeder, 'order' => $order]),
                    'SendDate' => Carbon::now(),
                    'CreatedBy' => Auth::user()->Email
        ]);

        $region = RegionDealer::where('RegionId', $breeder->NurseryRegionId)->first();
        if ($region) {
            foreach (explode(',', $region->Emails) as $em) {
                if (trim($em)) {

                    \App\Services\Mail::SendOrderManagerMail(trim($em), "Заказ №" . $orderID . " от " . $order->CreatedAt, $breeder, $order);

                    $emailRD = Email::create([
                                'EmailFrom' => 'noreply@response.ru',
                                'NameFrom' => 'PERFECT FIT',
                                'EmailTo' => trim($em),
                                'Subject' => "Заказ №" . $orderID . " от " . $order->CreatedAt,
                                'Text' => view('emails.orderManager', ['breeder' => $breeder, 'order' => $order]),
                                'SendDate' => Carbon::now(),
                                'CreatedBy' => Auth::user()->Email
                    ]);
                }
            }
        }

        BreederNotification::create([
            'Subject' => "Заказ №" . $orderID . " от " . $order->CreatedAt . " сформирован",
            'BreederId' => $breeder->Id
        ]);

        return redirect('/cabinet/orders');
    }

    public function calculateOrderDetails(OrderRequest $request) {
        $breeder = Auth::user()->breeders()->first();
        $breederBreed = $breeder->breederBreeds()->where('Id', $request->BreederBreedId)->first();
        $breedSize = $breederBreed->breed->breedSize;

        return response()->json([
                    'Поставка до' => (new Order())->orderDeliveryDate($request->LitterDate)->format('Y-m-d'),
                    'Корм' => (new Product())->getProductForSize($breedSize->Mnemonic)->Name,
                    'Количество упаковок' => (new Order)->orderPackageCount($breedSize->Mnemonic) * $request->PetCount,
                    'Количество подарков' => $request->PetCount]);
    }

    public function order(Request $request, $Id) {
        $breeder = Auth::user()->breeders()->first();
        $order = $breeder->orders()->where('OrderId', $Id)->first();
        $breederBreed = $order->breederBreed()->first();
        $breedSize = $breederBreed->breed->breedSize;

        if (!$order) {
            return redirect('/cabinet/orders');
        }

        $responses = $breeder
                ->join('Forms', 'BreederId', '=', 'Breeders.Id')
                ->join('Responses', 'Responses.FormId', '=', 'Forms.Id')
                ->where('Forms.OrderId', $order->Id);

        return view('cabinet.order', [
            'order' => $order,
            'product' => (new Product())->getProductForSize($breedSize->Mnemonic)->Name,
            'form' => $breeder->forms()->where('OrderId', $order->Id)->orderBy('CreatedAt'),
            'responses' => $responses
        ]);
    }

    public function uploadFormOwner(Request $request, $Id) {
        $breeder = Auth::user()->breeders()->first();
        $order = $breeder->orders()->where('OrderId', $Id)->first();
        if (!$order) {
            return ['error' => 1, 'message' => 'Заказ не найден'];
        }
        $images = $request->uploadFormOwner ?? null;
        $form = null;
        foreach ($images as $key => $image) {
            if (!$image instanceof UploadedFile) {
                return ['error' => 1, 'message' => 'Нет валидного файла'];
            }

            $responses = $breeder
                    ->join('Forms', 'BreederId', '=', 'Breeders.Id')
                    ->join('Responses', 'Responses.FormId', '=', 'Forms.Id')
                    ->where('Forms.OrderId', $order->Id)
                    ->where('Responses.Valid', 1);

            if ($order->PetCount <= $responses->count()) {
                return ['error' => 1, 'message' => 'Вы уже отчитались по всем щенкам этого заказа'];
            }

            $filename = md5(time() . $key) . '.' . $image->extension();
            $image->move(storage_path('app/external/forms/'), $filename);
            $form = Form::create([
                        'BreederId' => $breeder->Id,
                        'LocalFile' => $filename,
                        'OrderId' => $order->Id
            ]);
        }
        if ($form) {
            return ['error' => 0, 'message' => 'Файл загружен'];



            BreederNotification::create([
                'Subject' => "Загружена анкета по заказу " . $order->Id,
                'BreederId' => $breeder->Id
            ]);
        }

        return ['error' => 1, 'message' => 'Не получилось загрузить файл'];
    }

    public function formImage($id) {
        $breeder = Auth::user()->breeders()->first();
        $form = $breeder->forms()->find($id);
        return Image::make($form->imageFileName())->response();
    }

    public function updatePassword(PasswordRequest $request) {
        $user = AspNetUser::find(Auth::id());
        $user->PasswordHash = (new Service())->hashPassword($request->Password);
        $user->save();
        return ['error' => 0, 'message' => 'Пароль изменен!'];
    }

    public function sendMessage(Request $request) {
        $breeder = Auth::user()->breeders()->first();
        $noti = BreederSupport::create([
                    'Text' => $request->msg,
                    'BreederId' => $breeder->Id
        ]);
        return ['error' => 0, 'message' => 'Отправлено!'];
    }

    public function getNotifications(Request $request) {
        $breeder = Auth::user()->breeders()->first();
        $noti = BreederNotification::where(['BreederId' => $breeder->Id])->orderBy('CreatedAt', 'DESC')->get();

        BreederNotification::where(['BreederId' => $breeder->Id, 'ReadDate' => null])->update(['ReadDate' => Carbon::now()]);

        return view('cabinet.notifications', [
            'notifications' => $noti
        ]);
    }

    public function getSupport(Request $request) {
        $breeder = Auth::user()->breeders()->first();
        $supports = BreederSupport::where(['BreederId' => $breeder->Id])->orderBy('CreatedAt', 'DESC')->get();
        return view('cabinet.support', [
            'supports' => $supports
        ]);
    }

    public function rulesAccepted(Request $request) {
        if ($request->RulesAccepted && $request->RulesAccepted2) {
            $breeder = Auth::user()->breeders()->first();
            $breeder->RulesAccepted = 1;
            $breeder->save();

            return ['error' => 0];
        }
        return ['error' => 1, 'message' => 'Вам нужно принять правила программы и пользовательское соглашение.'];
    }

}
