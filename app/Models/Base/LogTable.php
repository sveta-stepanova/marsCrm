<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class LogTable extends AbstractTable {

    /**
     * Generated
     */

    protected $table = 'LogTables';
    protected $fillable = ['Id', 'NumericId', 'KeyId', 'TableName', 'LogOperationId', 'CreatedAt', 'CreatedBy'];


    public function logOperation() {
        return $this->belongsTo(\App\Models\LogOperation::class, 'LogOperationId', 'Id');
    }

    public function logFields() {
        return $this->hasMany(\App\Models\LogField::class, 'LogTableId', 'Id');
    }


}
