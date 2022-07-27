<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ResponseSearchRequest
 * @package App\Http\Requests
 * @property string FirstName
 * @property string LastName
 * @property string Patronymic
 * @property string Phone
 * @property string Email
 */
class ResponseSearchRequest extends FormRequest {
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
		];
	}
}
