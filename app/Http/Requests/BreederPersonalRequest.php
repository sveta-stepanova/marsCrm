<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class BreederPersonalRequest
 * @package App\Http\Requests
 * @property string Username
 * @property string Password
 */
class BreederPersonalRequest extends FormRequest {
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
			'Phone' => 'required|phone',
                        'Email' => 'required|email|unique:AspNetUsers,UserName,' . Auth::id() . ',Id'
		];
	}
}
