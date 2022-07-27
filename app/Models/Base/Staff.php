<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Staff extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'Staffs';
    protected $fillable = ['Id', 'UserId', 'Email', 'Name', 'Phone', 'DismissDate', 'DismissUser', 'ImportManagerId', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function aspNetUser() {
        return $this->belongsTo(\App\Models\AspNetUser::class, 'UserId', 'Id');
    }

    public function fias() {
        return $this->belongsToMany(\App\Models\Fias::class, 'RegionManagers', 'ManagerId', 'FiasId');
    }

    public function managedBreeders() {
        return $this->hasMany(\App\Models\Breeder::class, 'ManagerId', 'Id');
    }

    public function approvedBreeders() {
        return $this->hasMany(\App\Models\Breeder::class, 'ApprovedBy', 'Id');
    }

    public function breederSupports() {
        return $this->hasMany(\App\Models\BreederSupport::class, 'StaffId', 'Id');
    }

    public function checkedOutForms() {
        return $this->hasMany(\App\Models\Form::class, 'CheckedOutBy', 'Id');
    }

    public function validatedForms() {
        return $this->hasMany(\App\Models\Form::class, 'ValidatedBy', 'Id');
    }

    public function regionManagers() {
        return $this->hasMany(\App\Models\RegionManager::class, 'ManagerId', 'Id');
    }


}
