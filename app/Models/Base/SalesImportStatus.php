<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SalesImportStatus extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'SalesImportStatus';
    protected $fillable = ['Id', 'Name', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function salesImports() {
        return $this->belongsToMany(\App\Models\SalesImport::class, 'SalesImportItems', 'ImportStatusId', 'SalesImportId');
    }

    public function salesImportItems() {
        return $this->hasMany(\App\Models\SalesImportItem::class, 'ImportStatusId', 'Id');
    }


}
