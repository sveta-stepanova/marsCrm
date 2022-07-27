<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Breed extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'Breeds';
    protected $fillable = ['Id', 'Name', 'SizeId', 'MinWeight', 'MaxWeight', 'ExternalId', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function breedSize() {
        return $this->belongsTo(\App\Models\BreedSize::class, 'SizeId', 'Id');
    }

    public function forms() {
        return $this->belongsToMany(\App\Models\Form::class, 'Responses', 'BreedId', 'FormId');
    }

    public function breederBreeds() {
        return $this->hasMany(\App\Models\BreederBreed::class, 'BreedId', 'Id');
    }

    public function responses() {
        return $this->hasMany(\App\Models\Response::class, 'BreedId', 'Id');
    }


}
