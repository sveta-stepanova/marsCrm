<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class BreedersPlusAgree extends AbstractTable {

    /**
     * Generated
     */

    protected $table = 'BreedersPlusAgrees';
    protected $fillable = ['Id', 'BreederId', 'CreatedDate', 'Author'];


    public function breeder() {
        return $this->belongsTo(\App\Models\Breeder::class, 'BreederId', 'Id');
    }


}
