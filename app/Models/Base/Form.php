<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Form extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'Forms';
    protected $fillable = ['Id', 'BreederId', 'RemoteURL', 'LocalFile', 'ExternalId', 'OrderId', 'CheckedOutAt', 'CheckedOutBy', 'ValidatedAt', 'ValidatedBy', 'FormStateId', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function checkedOutByOperator() {
        return $this->belongsTo(\App\Models\Staff::class, 'CheckedOutBy', 'Id');
    }

    public function validatedByOperator() {
        return $this->belongsTo(\App\Models\Staff::class, 'ValidatedBy', 'Id');
    }

    public function breeder() {
        return $this->belongsTo(\App\Models\Breeder::class, 'BreederId', 'Id');
    }

    public function order() {
        return $this->belongsTo(\App\Models\Order::class, 'OrderId', 'Id');
    }

    public function formState() {
        return $this->belongsTo(\App\Models\FormState::class, 'FormStateId', 'Id');
    }

    public function breeds() {
        return $this->belongsToMany(\App\Models\Breed::class, 'Responses', 'FormId', 'BreedId');
    }

    public function responses() {
        return $this->hasMany(\App\Models\Response::class, 'FormId', 'Id');
    }


}
