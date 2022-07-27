<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Order extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'Orders';
    protected $fillable = ['Id', 'BreederId', 'BreederBreedId', 'OrderId', 'PetCount', 'PrizeCount', 'LitterDate', 'SupplyDate', 'DrySmallCount', 'DryLargeCount', 'PouchCount', 'PetBreed', 'PetWeight', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function breeder() {
        return $this->belongsTo(\App\Models\Breeder::class, 'BreederId', 'Id');
    }

    public function breederBreed() {
        return $this->belongsTo(\App\Models\BreederBreed::class, 'BreederBreedId', 'Id');
    }

    public function emails() {
        return $this->hasMany(\App\Models\Email::class, 'OrderId', 'Id');
    }

    public function forms() {
        return $this->hasMany(\App\Models\Form::class, 'OrderId', 'Id');
    }


}
