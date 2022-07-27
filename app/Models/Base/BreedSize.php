<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BreedSize extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'BreedSizes';
    protected $fillable = ['Id', 'ExternalId', 'GroupId', 'Name', 'Mnemonic', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function breedSizeGroup() {
        return $this->belongsTo(\App\Models\BreedSizeGroup::class, 'GroupId', 'Id');
    }

    public function breeds() {
        return $this->hasMany(\App\Models\Breed::class, 'SizeId', 'Id');
    }


}
