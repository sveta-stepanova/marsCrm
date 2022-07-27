<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Schema extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'Schemas';
    protected $fillable = ['Id', 'KeyId', 'Name', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function breeders() {
        return $this->hasMany(\App\Models\Breeder::class, 'SchemaId', 'Id');
    }


}
