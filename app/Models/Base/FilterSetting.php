<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Base\FilterSetting
 *
 * @property int $Id
 * @property string $UserName
 * @property string $Name
 * @property string $FilterText
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FilterSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FilterSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FilterSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FilterSetting whereFilterText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FilterSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FilterSetting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FilterSetting whereUserName($value)
 * @mixin \Eloquent
 */
class FilterSetting extends AbstractTable {

    /**
     * Generated
     */

    protected $table = 'FilterSettings';
    protected $fillable = ['Id', 'UserName', 'Name', 'FilterText'];



}
