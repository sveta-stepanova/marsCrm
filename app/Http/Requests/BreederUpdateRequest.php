<?php

namespace App\Http\Requests;

use App\Models\Breeder;
use Illuminate\Foundation\Http\FormRequest;
use App\Brands\AbstractBrand;
use App\Brands\Pedigree;

/**
 * Class BreederUpdateRequest
 * @package App\Http\Requests
 *
 * @property string $FirstName
 * @property string $LastName
 * @property string $Patronymic
 * @property string $BirthDate
 * @property string $Phone
 * @property string $NurseryName
 * @property string $FciRegDate
 * @property string $NurseryRegionId
 * @property string $NurseryCityId
 * @property string $NurseryStreet
 * @property string $NurseryHouse
 * @property string $NurseryFlat
 * @property string $NurseryPhone
 * @property string $RegCertificateNum
 * @property array $Breed
 * @property string $BroodFemalesCount
 * @property string $FamilyTreeFileId
 * @property string $SchemaId
 * @property string $TermsAccepted
 * @property string $Edit
 * @property string $Email
 * @property string $Signature
 */
class BreederUpdateRequest extends FormRequest {
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
	public function rules(): array {
            
            
            $brand = \App::make(AbstractBrand::class);
            
            $allRules = [
			'FirstName' => 'required|max:100',
			'LastName' => 'required|max:100',
			'Patronymic' => 'required|max:100',
//			'BirthDate' => 'required|date|before:now',
			'Phone' => 'required|phone',
			'NurseryName' => 'required|max:100',
			'FciRegDate' => 'date|before:now',
			'NurseryRegionId' => 'required|uuid',
			'NurseryCityId' => 'required|uuid',
			'NurseryStreet' => 'required',
			'NurseryHouse' => 'required',
                        'NurseryBuild' => '',
			'NurseryFlat' => '',
//			'NurseryPhone' => 'required',
			'RegCertificateNum' => '',
			'Breed' => 'required|min:1|max:5',
			'Breed.*.Id' => 'uuid',
			'Breed.*.Quantity' => 'required_with:Breed.*.Id|int|min:1',
			'Breed.*.Weight' => 'required_with:Breed.*.Id|breed_weight',
			'BroodFemalesCount' => 'required|int|min:1',
			'TermsAccepted' => 'required',
		];
            
            if ($brand instanceof Pedigree) {
                
                $allRulesBrand = [
                    'SchemaId' => 'required|in:1,2,3',
                    'FamilyTreeFileId' => 'required|uploaded_file'
                ];
                
                $allRules = array_merge($allRules, $allRulesBrand);
		
		if (!$this->Edit) {
			return $allRules;
		}
		$breeder = Breeder::where(['Email' => $this->Email])->firstOrFail();
		$filteredRules = [];
		foreach ($allRules as $field => $restrictions) {
//			if ($field == 'FamilyTreeFileId') {
//				continue;
//			}
			$fieldWanted =
				substr($field, 0, 5) == 'Breed'
				|| $field == 'BroodFemalesCount'
				|| $field == 'SchemaId'
				|| !$breeder->$field;
			if ($fieldWanted) {
				$filteredRules[$field] = $restrictions;
			}
		}
		return $filteredRules;
                
            } else {
                
                $allRulesBrand = [
                    'Email' => 'required|email|unique:AspNetUsers,UserName',
                    'Password' => 'required|min:8|max:32|password',
                    'Password_1' => 'required|same:Password|password',
                    'RulesAccepted' => 'required',
                    'Agree18' => 'required',
//                    'FamilyTree'   => 'array|required',
//                    'FamilyTree.*' => 'required|mimes:jpeg,png,jpg,svg'
                ];
                
                $allRules = array_merge($allRules, $allRulesBrand);
                
                return $allRules;
            }
	}
}
