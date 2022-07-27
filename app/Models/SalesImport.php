<?php
namespace App\Models;

/**
 * App\Models\SalesImport
 *
 * @property string $Id
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property int $NumericId
 * @property int $Year
 * @property int $Week
 * @property string $WeekStartDate
 * @property string|null $Comments
 * @property string $FileName
 * @property string $ContentType
 * @property string $Extension
 * @property bool|null $CCRecounted
 * @property string $CreatedBy
 * @property-read \App\Models\Manager $manager
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SalesImportItem[] $salesImportItems
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SalesImportStatus[] $salesImportStatuses
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImport query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImport whereCCRecounted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImport whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImport whereContentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImport whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImport whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImport whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImport whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImport whereNumericId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImport whereWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImport whereWeekStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImport whereYear($value)
 * @mixin \Eloquent
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalesImport whereDeletedBy($value)
 */
class SalesImport extends Base\SalesImport {
	//
}

