<?php
namespace App\Models;

/**
 * App\Models\SalesImportStatus
 *
 * @property string $Id
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property string $Name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SalesImportItem[] $salesImportItems
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SalesImport[] $salesImports
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportStatus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportStatus whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportStatus whereDeletedBy($value)
 * @property int|null $ImportId
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImportStatus whereImportId($value)
 */
class SalesImportStatus extends Base\SalesImportStatus {
	//
}

