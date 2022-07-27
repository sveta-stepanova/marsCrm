<?php

/**
 * Created by PhpStorm.
 * User: muto
 * Date: 11.01.19
 * Time: 19:42
 */

namespace App\Brands;

use App\Exceptions\AppException;
use App\Models\AspNetUser;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Route;

class PerfectFit extends AbstractBrand {

    public function getRegistrationRedirectUrl(): string {
        // TODO: Implement getRegistrationRedirectUrl() method.
        throw new \Exception('Redirect url not specified');
    }

    public function getOperatorAuthUrl(): string {
        // TODO: Implement getOperatorAuthUrl() method.
        //throw new \Exception('Auth url not specified');
        return 'https://perfectfit.response.ru/PerfectFitAdmin/Account/LoginOperator';
    }

    public function getViewDir(): string {
        return 'perfectfit';
    }

    public function setupRoutes(): void {
        Route::get('/register', 'BreederAccountController@registrationForm')->name('reg-form');
        Route::get('/', function(Guard $guard) {
            /** @var AspNetUser $user */
            $user = $guard->user();
            if ($user) {
                if ($user->breeders()->count()) {
                    // it's a breeder
                    return redirect('/cabinet');
                } elseif ($user->staff()->count()) {
                    // it's an operator
                    return redirect('/oper');
                } else {
                    throw AppException::couldNotDefineRole();
                }
            } else {
                return view('index');
            }
        });
        Route::group(['prefix' => 'cabinet', 'middleware' => 'auth:breeder,breeder-login'], function() {
        	Route::get('', 'BreederCabinetController@index');
                Route::post('', 'BreederCabinetController@edit');
		Route::get('orders', 'BreederCabinetController@orders');
                Route::get('orders-history', 'BreederCabinetController@ordersHistory');
                Route::post('orders', 'BreederCabinetController@orderProcessing');
		Route::get('nursery', 'BreederCabinetController@nursery');
                Route::get('banners', function() { return view('cabinet.banners'); });
                Route::get('notifications', 'BreederCabinetController@getNotifications');
                Route::get('support', 'BreederCabinetController@getSupport');
                Route::get('purchase-history', function() { return view('cabinet.purchaseHistory'); });
                Route::get('rules', function() { return view('cabinet.rules'); });
                Route::get('informational_resources', function() { return view('cabinet.infoResources'); });
                Route::get('reviews', function() { return view('cabinet.reviews'); });
                Route::post('order/calculate', 'BreederCabinetController@calculateOrderDetails');
                Route::get('order/{Id}', 'BreederCabinetController@order');
                Route::post('upload/form/{Id}', 'BreederCabinetController@uploadFormOwner');
                Route::get('form/{Id}/image', 'BreederCabinetController@formImage');
                Route::get('form', function() { return view($this->getViewDir() . '.cabinet.form'); });
                Route::any('new_password', 'BreederCabinetController@updatePassword');
                Route::post('send-message', 'BreederCabinetController@sendMessage');
                Route::post('rules-accepted', 'BreederCabinetController@rulesAccepted');
        });
        Route::get('/login', 'AuthController@breederLoginForm')->name('breeder-login');
        Route::post('/login', 'AuthController@breederLogin');
        Route::get('/logout', 'AuthController@Logout');
        Route::get('/restore', 'AuthController@RestoreForm');
        Route::post('/restore', 'AuthController@Restore');
        
    }
}
