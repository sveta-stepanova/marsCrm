<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BonusConfirmation extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'BonusConfirmations';
    protected $fillable = ['Id', 'BonusId', 'OrderedProductId', 'Quantity', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function bonusProduct() {
        return $this->belongsTo(\App\Models\BonusProduct::class, 'BonusId', 'Id');
    }

    public function orderedProduct() {
        return $this->belongsTo(\App\Models\OrderedProduct::class, 'OrderedProductId', 'Id');
    }


}
