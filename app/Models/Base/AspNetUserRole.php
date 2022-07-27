<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class AspNetUserRole extends AbstractTable {

    /**
     * Generated
     */

    protected $table = 'AspNetUserRoles';
    protected $fillable = ['UserId', 'RoleId', 'CreatedAt'];


    public function aspNetRole() {
        return $this->belongsTo(\App\Models\AspNetRole::class, 'RoleId', 'Id');
    }

    public function aspNetUser() {
        return $this->belongsTo(\App\Models\AspNetUser::class, 'UserId', 'Id');
    }


}
