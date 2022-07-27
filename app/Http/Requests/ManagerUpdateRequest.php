<?php

namespace App\Http\Requests;

use App\Models\Breeder;
use Illuminate\Foundation\Http\FormRequest;
use App\Brands\AbstractBrand;

/**
 * Class ManagerUpdateRequest
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
class ManagerUpdateRequest extends FormRequest {

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
        return [
            'Name' => 'required|max:100',
            'Phone' => 'required|phone',
            'Email' => 'required|email|unique:AspNetUsers,UserName',
            'Password' => 'required|min:8|max:32|password'
        ];
    }

}
