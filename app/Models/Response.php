<?php

namespace App\Models;

use App\Http\Requests\BreederResponseRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * App\Models\Response
 *
 * @property string $Id
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property string $CreatedBy
 * @property string $FormId
 * @property string $PetName
 * @property string|null $PetDateOfBirth
 * @property string|null $BreedId
 * @property string|null $FirstName
 * @property string|null $LastName
 * @property string|null $Patronymic
 * @property string|null $Email
 * @property string|null $Phone
 * @property bool $Valid
 * @property string|null $ValidationErrors
 * @property-read \App\Models\Breed|null $breed
 * @property-read \App\Models\Form $form
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Response newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Response newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Response query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Response whereBreedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Response whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Response whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Response whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Response whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Response whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Response whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Response whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Response whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Response wherePatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Response wherePetDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Response wherePetName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Response wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Response whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Response whereValid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Response whereValidationErrors($value)
 * @mixin \Eloquent
 * @property mixed $validation_errors
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Response whereDeletedBy($value)
 * @property bool|null $Sign
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Response whereSign($value)
 */
class Response extends Base\Response {

    public function updateFromRequest(Request $request, ?array $fields = null) {
        if (!($request instanceof BreederResponseRequest)) {
            throw new \Exception('Invalid request class');
        }
        if (!$fields) {
            $fields = [
                'PetName',
                'BreedId',
                'FirstName',
                'LastName',
                'Patronymic',
                'Email',
                'Phone',
                'Sign'
            ];
        }
        parent::updateFromRequest($request, $fields);

        $this->PetDateOfBirth = (new Carbon($request->PetDateOfBirth))->format('Y-m-d');

        // According to invalid records (not validity rules that ere written ages ago) in old DB, mandatory fields are
        // name (first, last, patronymic) and phone. Other stuff may be empty.
        $this->Valid = /* $this->PetName && $this->PetDateOfBirth && $this->BreedId && */
                $this->FirstName && $this->LastName && $this->Patronymic && $this->Phone && $request->Sign
        /* && $this->Email */;

        $err = [];
        foreach ($request->toArray() as $var => $value) {
            if (strpos($var, 'Error') !== false && $value) {
                $err[str_replace('Error', '', $var)] = $value;
            }
        }
        if (!$request->Sign) {
            $err['Sign'] = 'missing';
        }
        $this->ValidationErrors = $err;
        
        
    }

    public function getValidationErrorsAttribute($value) {
        return $value ? json_decode($value) : [];
    }

    public function setValidationErrorsAttribute($value) {
        $this->attributes['ValidationErrors'] = $value ? json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : null;
    }

}
