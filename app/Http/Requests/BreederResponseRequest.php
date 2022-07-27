<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BreederResponseRequest
 * @package App\Http\Requests
 * @property string $BreedId;
 * @property string $Email;
 * @property string $FirstName;
 * @property string $LastName;
 * @property string $Patronymic;
 * @property string $PetDateOfBirth;
 * @property string $PetName;
 * @property string $Phone;
 * @property string $BreedIdError;
 * @property string $EmailError;
 * @property string $FirstNameError;
 * @property string $LastNameError;
 * @property string $PatronymicError;
 * @property string $PetDateOfBirthError;
 * @property string $PetNameError;
 * @property string $PhoneError;
 * @property string $NoSign
 */
class BreederResponseRequest extends FormRequest {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	public function fields() {
		return [
			'BreedId',
			'Email',
			'FirstName',
			'LastName',
			'Patronymic',
			'PetDateOfBirth',
			'PetName',
			'Phone',
		];
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		$rules = [];
		foreach ($this->fields() as $field) {
			$rules[$field] = 'required_without:' . $field . 'Error';
			$rules[$field . 'Error'] = 'in:empty,unreadable';
		}
		$rules['PetDateOfBirth'] .= '|date';
		$rules['Phone'] .= '|phone';
		$rules['Email'] .= '|email';
		return $rules;
	}
}
