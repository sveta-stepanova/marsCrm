<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class LogOperation extends AbstractTable {

    /**
     * Generated
     */

    protected $table = 'LogOperations';
    protected $fillable = ['Id', 'Name'];


    public function logTables() {
        return $this->hasMany(\App\Models\LogTable::class, 'LogOperationId', 'Id');
    }


}
