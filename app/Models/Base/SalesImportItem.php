<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SalesImportItem extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'SalesImportItems';
    protected $fillable = ['Id', 'SalesImportId', 'SapId', 'VendorCode', 'Quantity', 'ImportStatusId', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function salesImportStatus() {
        return $this->belongsTo(\App\Models\SalesImportStatus::class, 'ImportStatusId', 'Id');
    }

    public function salesImport() {
        return $this->belongsTo(\App\Models\SalesImport::class, 'SalesImportId', 'Id');
    }


}
