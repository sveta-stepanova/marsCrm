<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class UsersLog extends AbstractTable {

    /**
     * Generated
     */

    protected $table = 'UsersLogs';
    protected $fillable = ['Id', 'UserName', 'Password', 'Ip', 'CreatedAt', 'ReturnUrl', 'Result'];



}
