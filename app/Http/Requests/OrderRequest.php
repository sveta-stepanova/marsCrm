<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class OrderRequest
 * @package App\Http\Requests
 * @property string Username
 * @property string Password
 */
class OrderRequest extends FormRequest {
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
			'LitterDate' => 'required|date|litter_date_start|litter_date_end',
			'BreederBreedId' => 'required|breeder_breed|uuid',
                        'PetCount' => 'required|min:1|integer|pet_count'
		];
	}
}
