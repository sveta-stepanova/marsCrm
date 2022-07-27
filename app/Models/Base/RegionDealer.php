<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class RegionDealer extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'RegionDealers';
    protected $fillable = ['Id', 'RegionId', 'Name', 'Emails', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy', 'CityId'];


    

    public function fium() {
        return $this->belongsTo(\App\Models\Fias::class, 'RegionId', 'Id');
    }

    public function breeders() {
        return $this->hasMany(\App\Models\Breeder::class, 'RegionDealerId', 'Id');
    }


}
