<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class UserPersonalSetting extends AbstractTable {

    /**
     * Generated
     */

    protected $table = 'UserPersonalSettings';
    protected $fillable = ['Id', 'UserName', 'Name', 'FilterText'];



}
