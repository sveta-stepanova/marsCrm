<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BonusProduct extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'BonusProducts';
    protected $fillable = ['Id', 'KeyId', 'BreederId', 'ProductGroupId', 'BonusTypeId', 'DispatchedAt', 'DispatchedEditUser', 'DispatchedComments', 'CompletedAt', 'CompletedSetAt', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function productGroup() {
        return $this->belongsTo(\App\Models\ProductGroup::class, 'ProductGroupId', 'Id');
    }

    public function bonusType() {
        return $this->belongsTo(\App\Models\BonusType::class, 'BonusTypeId', 'Id');
    }

    public function breeder() {
        return $this->belongsTo(\App\Models\Breeder::class, 'BreederId', 'Id');
    }

    public function orderedProducts() {
        return $this->belongsToMany(\App\Models\OrderedProduct::class, 'BonusConfirmations', 'BonusId', 'OrderedProductId');
    }

    public function bonusConfirmations() {
        return $this->hasMany(\App\Models\BonusConfirmation::class, 'BonusId', 'Id');
    }

    public function emails() {
        return $this->hasMany(\App\Models\Email::class, 'BonusProductId', 'Id');
    }


}
