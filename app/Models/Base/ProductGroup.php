<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ProductGroup extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'ProductGroups';
    protected $fillable = ['Id', 'NumericId', 'Name', 'Scheme1Pack', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function bonusProducts() {
        return $this->hasMany(\App\Models\BonusProduct::class, 'ProductGroupId', 'Id');
    }

    public function products() {
        return $this->hasMany(\App\Models\Product::class, 'GroupId', 'Id');
    }


}
