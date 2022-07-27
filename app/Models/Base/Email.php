<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class Email extends AbstractTable {

    /**
     * Generated
     */

    protected $table = 'Emails';
    protected $fillable = ['Id', 'EmailFrom', 'NameFrom', 'EmailTo', 'Subject', 'Text', 'SendDate', 'ReadDate', 'FailedDate', 'ResultMessage', 'OrderId', 'BonusProductId', 'BreederPlusId', 'CreatedAt', 'CreatedBy'];


    public function bonusProduct() {
        return $this->belongsTo(\App\Models\BonusProduct::class, 'BonusProductId', 'Id');
    }

    public function breedersPlus() {
        return $this->belongsTo(\App\Models\BreedersPlus::class, 'BreederPlusId', 'Id');
    }

    public function order() {
        return $this->belongsTo(\App\Models\Order::class, 'OrderId', 'Id');
    }


}
