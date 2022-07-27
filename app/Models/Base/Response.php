<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Response extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'Responses';
    protected $fillable = ['Id', 'FormId', 'PetName', 'PetDateOfBirth', 'BreedId', 'FirstName', 'LastName', 'Patronymic', 'Email', 'Phone', 'Sign', 'Valid', 'ValidationErrors', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy', 'SendDate', 'KeyId', 'FailDate', 'ResultText'];


    public function breed() {
        return $this->belongsTo(\App\Models\Breed::class, 'BreedId', 'Id');
    }

    public function form() {
        return $this->belongsTo(\App\Models\Form::class, 'FormId', 'Id');
    }


}
