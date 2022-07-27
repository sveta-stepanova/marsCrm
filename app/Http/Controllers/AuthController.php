<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RestoreRequest;
use App\Models\AspNetUser;
use App\Models\PassReset;
use App\Models\Email;
use Carbon\Carbon;
use App\Services\Auth as Service;
//use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Services\Mail as MailService;

class AuthController extends Controller {

    public function operLogin(LoginRequest $request) {
        $user = AspNetUser::where(['UserName' => $request->Username])->first();
        if (!$user || !$user->externalOperatorAuthAttempt($request->Password, $request->ip())) {
            return Redirect::back()->withErrors(['Username' => ['Неверная комбинация логина и пароля']]);
        }
        return Redirect::route('oper-dashboard');
    }
    
    public function operLoginForm() {
        if ($this->user && $this->user->staff()->count()) {
            return redirect('/oper');
        }
        return view('oper.login', ['wrapId' => 'auth']);
    }
    
    public function AdminLogin(LoginRequest $request) {
        $user = AspNetUser::where(['UserName' => $request->Username])->first();
        if (!$user || !(new Service())->verifyHashedPassword($user->PasswordHash, $request->Password)) {
            return Redirect::back()->withErrors(['Username' => ['Неверная комбинация логина и пароля']]);
        }
        
        if (!$user->staff()->count()) {
            return redirect('/');
        }
        Auth::login($user);
       return redirect('/admin');
    }
    
    public function AdminLoginForm() {
        $user = Auth::user();
        if ($user && $user->staff()->count()) {
            return redirect('/admin');
        }
        return view('admin.login', ['wrapId' => 'auth']);
    }

    

    public function breederLoginForm() {
        if ($this->user && $this->user->breeders()->count()) {
            return redirect('/cabinet');
        }
        return view('login', ['wrapId' => 'auth']);
    }

    public function breederLogin(LoginRequest $request) {
        $user = AspNetUser::where(['UserName' => $request->Username])->first();
        if ($user && (new Service())->verifyHashedPassword($user->PasswordHash, $request->Password)) {
            if ($user->breeders()->first()->IsBlocked) {
                return Redirect::back()->withErrors(['Username' => ['Ваш аккаунт заблокирован']]);
            }
            Auth::login($user);

            return redirect('/cabinet');
        }
        return Redirect::back()->withErrors(['Username' => ['Неверная комбинация логина и пароля']]);
    }

    public function Logout(Request $request) {
        if ($this->user) {
            Auth::logout();
        }
        return redirect('/');
    }

    public function restoreForm() {
        if ($this->user && $this->user->breeders()->count()) {
            return redirect('/cabinet');
        }
        return view('restore', ['wrapId' => 'auth']);
    }

    public function Restore(Request $request) {
        if ($request->Email) {
            $user = AspNetUser::where(['UserName' => $request->Email])->first();
        }
        if (!isset($user) || empty($user)) {
            return ['error' => 1, 'message' => 'Пользователь с таким e-mail не найден.'];
        }

        $newPass = generateRandomString(8);
        $count = PassReset::where(['Email' => $request->Email])->whereBetween('CreatedAt', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()])->count();
        if ($count >= 5) {
            return ['error' => 1, 'message' => 'Превышен лимит на отправку восстановления пароля (5 раз в сутки).'];
        }

        if (PassReset::where(['Email' => $request->Email])->count()) {
            if (Carbon::now()->diffInMinutes(Carbon::parse(PassReset::where(['Email' => $request->Email])->max('CreatedAt'))) < 5) {
                return ['error' => 1, 'message' => 'С момента прошлого запроса на восстановление пароля не прошло 5 минут.'];
            }
        }
        
        \App\Services\Mail::SendResetMail($request->Email, $newPass);
         
        $email = Email::create([
                    'EmailFrom' => 'noreply@response.ru',
                    'NameFrom' => 'PerfectFit',
                    'EmailTo' => $user->Email,
                    'Subject' => 'Изменение пароля PERFECT FIT',
                    'Text' => view('emails.reset', ['Email' => $user->Email, 'Password' => $newPass]),
                    'SendDate' => Carbon::now(),
                    'CreatedBy' => $user->Email
            ]);
        if (!$email->Id) {
            return ['error' => 1, 'message' => 'Что-то пошло не так, попробуйте позднее.'];
        }
        $user->PasswordHash = (new Service())->hashPassword($newPass);
        $user->save();
        PassReset::create([
            'Email' => $user->Email
        ]);

        return ['error' => 0, 'message' => "Письмо с новым паролем отправлено на " . $user->UserName];
    }

}
