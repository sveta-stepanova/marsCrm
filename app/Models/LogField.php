<?php
namespace App\Models;

/**
 * App\Models\LogField
 *
 * @property string $Id
 * @property string $LogTableId
 * @property mixed $FieldName
 * @property string $NewValue
 * @property string $OldValue
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogField query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogField whereFieldName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogField whereLogTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogField whereNewValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogField whereOldValue($value)
 * @mixin \Eloquent
 * @property int $NumericId
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogField whereNumericId($value)
 */
class LogField extends Base\LogField {
	//
}

