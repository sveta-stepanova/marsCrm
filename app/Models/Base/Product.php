<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'Products';
    protected $fillable = ['Id', 'GroupId', 'Name', 'Weight', 'CalorificValue', 'VendorCode', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function productGroup() {
        return $this->belongsTo(\App\Models\ProductGroup::class, 'GroupId', 'Id');
    }

    public function orderedProducts() {
        return $this->hasMany(\App\Models\OrderedProduct::class, 'ProductId', 'Id');
    }


}
