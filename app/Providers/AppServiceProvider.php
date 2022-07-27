<?php

namespace App\Providers;

use App\Brands\AbstractBrand;
use App\Models\Breed;
use App\Models\Breeder;
use App\Models\AspNetUser;
use App\Rules\Phone;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Validator::extend('phone', function($attr, $value) {
        	/** @var Phone $validator */
        	$validator = App::make(Phone::class);
        	return $validator->passes($attr, $value);
		});
        Validator::extend('guid', function($attr, $value) { return !$value || Uuid::isValid($value); });
        Validator::extend('uploaded_file', function($attr, $value) { return !$value || !empty(Session::get($value)['contents']); });
        Validator::extend('password', function($attr, $value) { return preg_match('/^[A-Za-z0-9]+$/', $value);});
        Validator::extend('breed_weight', function($attr, $value) {
        	$request = App::make(\Illuminate\Http\Request::class);
        	$num = preg_replace('#[^0-9]#', '', $attr);
        	$breed = Breed::findOrFail($request->Breed[$num]['Id'] ?? null);
        	$value = (float)$value;
        	return !($breed->MaxWeight && $value > $breed->MaxWeight || $breed->MinWeight && $value < $breed->MinWeight);
		});
        Validator::extend('litter_date_start', function($attr, $value) {
            return (Carbon::parse($value)->format('Y-m-d') <= Carbon::now());
        });
        Validator::extend('litter_date_end', function($attr, $value) {
            return (Carbon::parse($value)->format('Y-m-d') > Carbon::now()->subDays(21));
        });
        Validator::extend('pet_count', function($attr, $value) {
            return (Auth::user()->breeders()->first()->limitPetCount()>=$value);
        });
        Validator::extend('breeder_breed', function($attr, $value) {
            $breeder = Auth::user()->breeders()->first();
            return ($breeder->breederBreeds()->where('Id', $value)->count());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
    	App::singleton(AbstractBrand::class, function() { return AbstractBrand::factory(); });
    	if (!(php_sapi_name() == 'cli' && in_array('package:discover', $_SERVER['argv']))) {
			DB::select('SET ANSI_NULLS, CONCAT_NULL_YIELDS_NULL, ANSI_WARNINGS, ANSI_PADDING ON');
		}
    }
}
