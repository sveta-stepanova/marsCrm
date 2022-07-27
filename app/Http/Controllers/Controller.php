<?php

namespace App\Http\Controllers;

use App\Brands\AbstractBrand;
use App\Models\AspNetUser;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var AbstractBrand  */
	protected $brand;
	/** @var AspNetUser */
	protected $user;

	public function __construct(AbstractBrand $brand) {
		$this->brand = $brand;
                $this->middleware(function($request, $next){
                    $guard = \Auth::guard();
                    $this->user = $guard->user();
                    return $next($request);
                });
	}

}
