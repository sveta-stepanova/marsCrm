<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BreederStatus extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'BreederStatuses';
    protected $fillable = ['Id', 'Name', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function breeders() {
        return $this->hasMany(\App\Models\Breeder::class, 'BreederStatusId', 'Id');
    }


}
