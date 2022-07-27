<?php
namespace App\Models;

/**
 * App\Models\LogOperation
 *
 * @property int $Id
 * @property string $Name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogOperation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogOperation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogOperation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogOperation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogOperation whereName($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LogTable[] $logTables
 */
class LogOperation extends Base\LogOperation {
	//
}

