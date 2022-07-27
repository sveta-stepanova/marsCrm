<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class OrderedProduct extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'OrderedProducts';
    protected $fillable = ['Id', 'BreederId', 'ProductId', 'OrderDate', 'Quantity', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function breeder() {
        return $this->belongsTo(\App\Models\Breeder::class, 'BreederId', 'Id');
    }

    public function product() {
        return $this->belongsTo(\App\Models\Product::class, 'ProductId', 'Id');
    }

    public function bonusProducts() {
        return $this->belongsToMany(\App\Models\BonusProduct::class, 'BonusConfirmations', 'OrderedProductId', 'BonusId');
    }

    public function bonusConfirmations() {
        return $this->hasMany(\App\Models\BonusConfirmation::class, 'OrderedProductId', 'Id');
    }


}
