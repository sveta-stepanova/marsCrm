<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class FiasLevel extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'FiasLevels';
    protected $fillable = ['Id', 'Name', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function fias() {
        return $this->hasMany(\App\Models\Fias::class, 'FiasLevelId', 'Id');
    }


}
