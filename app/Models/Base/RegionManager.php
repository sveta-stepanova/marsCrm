<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class RegionManager extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'RegionManagers';
    protected $fillable = ['Id', 'ManagerId', 'FiasId', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function staff() {
        return $this->belongsTo(\App\Models\Staff::class, 'ManagerId', 'Id');
    }

    public function fias() {
        return $this->belongsTo(\App\Models\Fias::class, 'FiasId', 'Id');
    }


}
