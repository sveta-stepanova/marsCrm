<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class FormState extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'FormStates';
    protected $fillable = ['Id', 'Name', 'IsValid', 'Description', 'Mnemonic', 'SetManually', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function forms() {
        return $this->hasMany(\App\Models\Form::class, 'FormStateId', 'Id');
    }


}
