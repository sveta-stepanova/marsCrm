<?php
/**
 * Created by PhpStorm.
 * User: muto
 * Date: 10.01.19
 * Time: 17:17
 */

namespace App;


use Illuminate\Support\Facades\App;

class Brand {

	public function isProfPedigree() {
		return config('app_instance.brand') == 'pedigree';
	}

	public function isPerfectFit() {
		return config('app_instance.brand') == 'perfectfit';
	}

	public function getRegistrationRedirectUrl() {
		switch (true) {
			case $this->isProfPedigree():
				return 'http://prof.pedigree.ru/lichnij-kabinet/?fabrika=ok';
			case $this->isPerfectFit():
				return '/cabinet';
			default:
				throw new \Exception('Failed to define brand');
		}
	}

}