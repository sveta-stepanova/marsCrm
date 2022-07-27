<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

use App\Brands\AbstractBrand;
use App\Brands\Pedigree;
use App\Exceptions\AppException;
use App\Http\Middleware\MustBeOperator;
use App\Http\Middleware\MustBeAdmin;
use App\Http\Middleware\Signature;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// {{{ Operator dashboard
Route::get('oper/login', 'AuthController@operLoginForm')->name('oper-login');
Route::post('oper/login', 'AuthController@operLogin');

Route::group(['middleware' => MustBeOperator::class], function() {
    Route::get('/oper', 'OperatorDashboardController@index')->name('oper-dashboard');
    Route::get('/oper/form/next', 'OperatorDashboardController@checkoutForm');
    Route::get('/oper/form/{id}', 'OperatorDashboardController@editForm');
    Route::get('/oper/form/{id}/image', 'OperatorDashboardController@formImage');
    Route::post('/oper/form/{formId}/response/{responseId?}', 'OperatorDashboardController@saveResponse');
    Route::get('/oper/form/{formId}/response/{responseId}', 'OperatorDashboardController@getResponse');
    Route::get('/oper/form/{formId}/response', 'OperatorDashboardController@listResponses');
    Route::post('/oper/form/{formId}/status', 'OperatorDashboardController@setFormStatus');
    Route::post('/oper/form/{formId}/finish', 'OperatorDashboardController@finishForm');
    Route::post('/oper/form/{formId}/search', 'OperatorDashboardController@search');
});
// }}}
// admin
Route::get('admin/login', 'AuthController@AdminLoginForm')->name('admin-login');
Route::post('admin/login', 'AuthController@AdminLogin');
Route::group(['middleware' => MustBeAdmin::class], function() {
    Route::get('/admin', function () {
        return redirect('/admin/perfectfit/breeders');
    })->name('admin');
    Route::get('/admin/perfectfit', function () {
        return redirect('/admin/perfectfit/breeders');
    });
    Route::any('/admin/{brand}/breeders/{new?}', 'AdminController@listBreeders');
    Route::any('/admin/{brand}/breeder/{id}', 'AdminController@getInfoBreeder');
    Route::post('/admin/edit-breeder/', 'AdminController@editBreeder');
    Route::post('/admin/breeder-get/{id}', 'AdminController@getBreeder');
    Route::post('/admin/manager-get/{id}', 'AdminController@getManager');
    Route::post('/admin/region-get/{id}', 'AdminController@getRegion');
    Route::post('/admin/reviews-get/{id}', 'AdminController@getReviews');
    Route::post('/admin/nursery-get/{id}', 'AdminController@getNursery');
    Route::post('/admin/purchase-history/{id}', 'AdminController@getPurchase');
    Route::post('/change-blocked', 'AdminController@changeBlocked');
    Route::post('/admin/add-review', 'AdminController@addReview');
    Route::post('/admin/edit-manager', 'AdminController@editManager');
    Route::post('/admin/edit-region', 'AdminController@editRegion');
    Route::post('/admin/edit-nursery', 'AdminController@editNursery');
    Route::post('/admin/add-manager', 'AdminController@addManager');
    Route::post('/admin/ship-bonus/{id}', 'AdminController@shipBonus');
    Route::post('/admin/delete-manager', 'AdminController@delManager');
    Route::post('/admin/delete-region', 'AdminController@delRegion');
    Route::post('/admin/delete-breeder', 'AdminController@delBreeder');
    Route::post('/admin/edit-region', 'AdminController@editRegion');
    Route::post('/admin/add-region', 'AdminController@addRegion');
    Route::any('/admin/{brand}/orders', 'AdminController@orders');
    Route::any('/admin/{brand}/orders-list', 'AdminController@ordersList');
    Route::any('/admin/{brand}/orders-info', 'AdminController@ordersInfo');
    Route::any('/admin/{brand}/orders-valid', 'AdminController@ordersValid');
    Route::any('/admin/{brand}/bonuses', 'AdminController@bonuses');
    Route::any('/admin/{brand}/reviews', 'AdminController@reviews');
    Route::any('/admin/{brand}/winners', 'AdminController@winners');
    Route::any('/admin/{brand}/issuance-prizes', 'AdminController@issuancePrizes');
    Route::any('/admin/{brand}/report', 'AdminController@enterReport');
    Route::any('/admin/{brand}/managers', 'AdminController@managers');
    Route::any('/admin/{brand}/sales-representatives', 'AdminController@salesRepresentatives');
    Route::any('/admin/{brand}/managers-orders', 'AdminController@managersOrders');
    Route::any('/admin/{brand}/regions', 'AdminController@regions');
    Route::any('/admin/{brand}/emails', 'AdminController@emails');
    Route::any('/admin/{brand}/import', 'AdminController@import');
    Route::any('/admin/{brand}/help-center', 'AdminController@helpCenter');
    Route::any('/admin/{brand}/help-center/{id}', 'AdminController@helpCenterMessage');
});

// {{{
/** @var AbstractBrand $brand */
$brand = App::make(AbstractBrand::class);

$brand->setupRoutes();

Route::post('/register', 'BreederAccountController@register')->middleware(Signature::class . ':pedigree');
Route::get('/register/cities/{regionId}/{pattern?}', 'BreederAccountController@cities');
Route::get('/register/breeds', 'BreederAccountController@breeds');
Route::post('/register/upload', 'BreederAccountController@upload');
Route::post('/send_question', 'BreederAccountController@sendQuestion');
// }}}






