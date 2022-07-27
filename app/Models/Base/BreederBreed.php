<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BreederBreed extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'BreederBreeds';
    protected $fillable = ['Id', 'BreederId', 'BreedId', 'TotalCount', 'AverageWeight', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy', 'MonthlyFoodConsumption'];


    public function breed() {
        return $this->belongsTo(\App\Models\Breed::class, 'BreedId', 'Id');
    }

    public function breeder() {
        return $this->belongsTo(\App\Models\Breeder::class, 'BreederId', 'Id');
    }

    public function orders() {
        return $this->hasMany(\App\Models\Order::class, 'BreederBreedId', 'Id');
    }


}
