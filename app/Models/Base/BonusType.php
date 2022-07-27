<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BonusType extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'BonusTypes';
    protected $fillable = ['Id', 'Name', 'Mnemonic', 'Quantity', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function bonusProducts() {
        return $this->hasMany(\App\Models\BonusProduct::class, 'BonusTypeId', 'Id');
    }


}
