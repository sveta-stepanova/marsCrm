<?php
/**
 * Created by PhpStorm.
 * User: muto
 * Date: 11.01.19
 * Time: 19:38
 */

namespace App\Brands;


use Illuminate\Support\Facades\App;

abstract class AbstractBrand {

	abstract public function getRegistrationRedirectUrl(): string;

	abstract public function getOperatorAuthUrl(): string;

	abstract public function setupRoutes(): void;

	abstract public function getViewDir(): string;
        
	public static function factory(): self {
		return App::make(PerfectFit::class);
		}
	}

