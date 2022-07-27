<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Pedigree extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'Pedigrees';
    protected $fillable = ['Id', 'BreederId', 'FileName', 'FileExt', 'CreatedAt', 'UpdatedAt', 'DeletedAt'];


    public function breeder() {
        return $this->belongsTo(\App\Models\Breeder::class, 'BreederId', 'Id');
    }


}
