<?php
namespace App\Models;

/**
 * App\Models\FilterSetting
 *
 * @property int $Id
 * @property string $UserName
 * @property string $Name
 * @property string $FilterText
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FilterSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FilterSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FilterSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FilterSetting whereFilterText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FilterSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FilterSetting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FilterSetting whereUserName($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FilterSetting whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FilterSetting whereDeletedBy($value)
 */
class FilterSetting extends Base\FilterSetting {
	//
}

