<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class RoleRight extends AbstractTable {

    /**
     * Generated
     */

    protected $table = 'RoleRights';
    protected $fillable = ['Id', 'RoleId', 'RightId', 'CreatedAt', 'CreatedBy'];


    public function aspNetRole() {
        return $this->belongsTo(\App\Models\AspNetRole::class, 'RoleId', 'Id');
    }

    public function right() {
        return $this->belongsTo(\App\Models\Right::class, 'RightId', 'Id');
    }


}
