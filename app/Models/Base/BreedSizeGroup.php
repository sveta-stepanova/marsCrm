<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BreedSizeGroup extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'BreedSizeGroups';
    protected $fillable = ['Id', 'Mnemonic', 'Scheme3Limit', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function breedSizes() {
        return $this->hasMany(\App\Models\BreedSize::class, 'GroupId', 'Id');
    }


}
