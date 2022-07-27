<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RestoreRequest
 * @package App\Http\Requests
 * @property string Email
 */
class PasswordRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
                            'Password' => 'required|min:8|max:32|password',
                            'Password_1' => 'required|same:Password|password'
		];
	}
}
