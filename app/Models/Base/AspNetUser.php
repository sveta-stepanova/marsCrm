<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class AspNetUser extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'AspNetUsers';
    protected $fillable = ['Id', 'UserName', 'Email', 'EmailConfirmed', 'PasswordHash', 'SecurityStamp', 'PhoneNumber', 'PhoneNumberConfirmed', 'TwoFactorEnabled', 'LockoutEndDateUtc', 'LockoutEnabled', 'AccessFailedCount', 'DeletedAt', 'CreatedAt', 'CreatedBy', 'DeletedBy', 'remember_token'];


    public function aspNetRoles() {
        return $this->belongsToMany(\App\Models\AspNetRole::class, 'AspNetUserRoles', 'UserId', 'RoleId');
    }

    public function aspNetUserClaims() {
        return $this->hasMany(\App\Models\AspNetUserClaim::class, 'UserId', 'Id');
    }

    public function aspNetUserLogins() {
        return $this->hasMany(\App\Models\AspNetUserLogin::class, 'UserId', 'Id');
    }

    public function aspNetUserRoles() {
        return $this->hasMany(\App\Models\AspNetUserRole::class, 'UserId', 'Id');
    }

    public function breeders() {
        return $this->hasMany(\App\Models\Breeder::class, 'UserId', 'Id');
    }

    public function staff() {
        return $this->hasMany(\App\Models\Staff::class, 'UserId', 'Id');
    }


}
