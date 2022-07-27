<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BreederBrand extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'BreederBrands';
    protected $fillable = ['Id', 'BrandId', 'BreederId', 'CreatedAt', 'DeletedAt'];



}
