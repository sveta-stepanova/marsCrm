<?php
namespace App\Models;

class RegionDealer extends Base\RegionDealer {
    
    
    public function fiumCity() {
        return $this->belongsTo(\App\Models\Fias::class, 'CityId', 'Id');
    }
	//
}

