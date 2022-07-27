<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Phone implements Rule {

	/**
	 * Create a new rule instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//
	}

	/**
	 * Determine if the validation rule passes.
	 *
	 * @param  string $attribute
	 * @param  mixed $value
	 * @return bool
	 */
	public function passes($attribute, $value) {
		return !!clearPhone($value);
	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message() {
		return 'Значение должно быть телефонным номером';
	}
}
