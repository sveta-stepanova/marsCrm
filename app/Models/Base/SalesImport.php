<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SalesImport extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'SalesImports';
    protected $fillable = ['Id', 'NumericId', 'Year', 'Week', 'WeekStartDate', 'Comments', 'FileName', 'ContentType', 'Extension', 'CCRecounted', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function salesImportStatuses() {
        return $this->belongsToMany(\App\Models\SalesImportStatus::class, 'SalesImportItems', 'SalesImportId', 'ImportStatusId');
    }

    public function salesImportItems() {
        return $this->hasMany(\App\Models\SalesImportItem::class, 'SalesImportId', 'Id');
    }


}
