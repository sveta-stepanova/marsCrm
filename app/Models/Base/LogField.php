<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class LogField extends AbstractTable {

    /**
     * Generated
     */

    protected $table = 'LogFields';
    protected $fillable = ['Id', 'NumericId', 'LogTableId', 'FieldName', 'NewValue', 'OldValue'];


    public function logTable() {
        return $this->belongsTo(\App\Models\LogTable::class, 'LogTableId', 'Id');
    }


}
