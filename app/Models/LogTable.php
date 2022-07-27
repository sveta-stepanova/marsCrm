<?php
namespace App\Models;

/**
 * App\Models\LogTable
 *
 * @property string $Id
 * @property string|null $KeyId
 * @property string $TableName
 * @property int $LogOperationId
 * @property string $DateLog
 * @property string $Author
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogTable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogTable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogTable query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogTable whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogTable whereDateLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogTable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogTable whereKeyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogTable whereLogOperationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogTable whereTableName($value)
 * @mixin \Eloquent
 * @property string $CreatedDate
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogTable whereCreatedDate($value)
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogTable whereCreatedAt($value)
 * @property string $CreatedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogTable whereCreatedBy($value)
 * @property int $NumericId
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogTable whereNumericId($value)
 */
class LogTable extends Base\LogTable {
	//
}

