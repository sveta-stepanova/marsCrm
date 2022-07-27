<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Fias extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'Fias';
    protected $fillable = ['Id', 'Name', 'FullName', 'FiasLevelId', 'ParentId', 'OriginalParentId', 'FlatShortName', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy', 'ShortName'];


    public function parentRecord() {
        return $this->belongsTo(\App\Models\Fias::class, 'ParentId', 'Id');
    }

    public function fiasLevel() {
        return $this->belongsTo(\App\Models\FiasLevel::class, 'FiasLevelId', 'Id');
    }

    public function staff() {
        return $this->belongsToMany(\App\Models\Staff::class, 'RegionManagers', 'FiasId', 'ManagerId');
    }

    public function childRecords() {
        return $this->hasMany(\App\Models\Fias::class, 'ParentId', 'Id');
    }

    public function regionDealers() {
        return $this->hasMany(\App\Models\RegionDealer::class, 'CityId', 'Id');
    }

    public function regionManagers() {
        return $this->hasMany(\App\Models\RegionManager::class, 'FiasId', 'Id');
    }


}
