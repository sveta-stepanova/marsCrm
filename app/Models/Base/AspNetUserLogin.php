<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class AspNetUserLogin extends AbstractTable {

    /**
     * Generated
     */

    protected $table = 'AspNetUserLogins';
    protected $fillable = ['LoginProvider', 'ProviderKey', 'UserId'];


    public function aspNetUser() {
        return $this->belongsTo(\App\Models\AspNetUser::class, 'UserId', 'Id');
    }


}
