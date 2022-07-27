<?php
/**
 * Created by PhpStorm.
 * User: muto
 * Date: 11.01.19
 * Time: 19:40
 */

namespace App\Brands;


use App\Http\Middleware\Signature;
use Illuminate\Support\Facades\Route;

class Pedigree extends AbstractBrand {

	public function getRegistrationRedirectUrl(): string {
		return 'http://prof.pedigree.ru/lichnij-kabinet/?fabrika=ok';
	}

	public function getOperatorAuthUrl(): string {
		return 'http://pro.russiadirect.ru/ProfPedigreeApi/api/Account/LoginOperator';
	}

	public function getViewDir(): string {
		return 'pedigree';
	}
        
        public function getSiteName(): string {
                return 'Prof Pegigree';
        }

	public function setupRoutes(): void {
		Route::get('/register', 'BreederAccountController@registrationForm')->name('reg-form')->middleware(Signature::class . ':pedigree');
		Route::get('/', function () {
			return redirect('/oper/login');
		});
		Route::get('/update-profile', 'BreederAccountController@updateProfileForm')->middleware(Signature::class . ':JoPa067243598')->name('update-profile-form');
		Route::post('/update-profile', 'BreederAccountController@updateProfile')->middleware(Signature::class . ':JoPa067243598');
	}

}