<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class AspNetRole extends AbstractTable {

    /**
     * Generated
     */

    protected $table = 'AspNetRoles';
    protected $fillable = ['Id', 'Name', 'DisplayName', 'Comments'];


    public function aspNetUsers() {
        return $this->belongsToMany(\App\Models\AspNetUser::class, 'AspNetUserRoles', 'RoleId', 'UserId');
    }

    public function rights() {
        return $this->belongsToMany(\App\Models\Right::class, 'RoleRights', 'RoleId', 'RightId');
    }

    public function aspNetUserRoles() {
        return $this->hasMany(\App\Models\AspNetUserRole::class, 'RoleId', 'Id');
    }

    public function roleRights() {
        return $this->hasMany(\App\Models\RoleRight::class, 'RoleId', 'Id');
    }


}
