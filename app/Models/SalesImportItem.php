<?php
namespace App\Models;

/**
 * App\Models\SalesImportItem
 *
 * @property string $Id
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property string $SalesImportId
 * @property int|null $SapId
 * @property string|null $VendorCode
 * @property int|null $Quantity
 * @property string|null $ImportStatusId
 * @property-read \App\Models\SalesImport $salesImport
 * @property-read \App\Models\SalesImportStatus|null $salesImportStatus
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportItem whereImportStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportItem whereSalesImportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportItem whereSapId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportItem whereVendorCode($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportItem whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportItem whereDeletedBy($value)
 */
class SalesImportItem extends Base\SalesImportItem {
	//
}

