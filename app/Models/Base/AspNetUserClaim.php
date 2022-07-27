<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class AspNetUserClaim extends AbstractTable {

    /**
     * Generated
     */

    protected $table = 'AspNetUserClaims';
    protected $fillable = ['Id', 'UserId', 'ClaimType', 'ClaimValue'];


    public function aspNetUser() {
        return $this->belongsTo(\App\Models\AspNetUser::class, 'UserId', 'Id');
    }


}
