<?php
namespace App\Models;

/**
 * App\Models\MenuItem
 *
 * @property int $Id Id
 * @property int $MenuId
 * @property string $Name Название
 * @property string $Controller Controller
 * @property string $Action Action
 * @property string|null $DependsOnSettingItem
 * @property bool $NeedDividerAftter
 * @property bool $IsActive Активен
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereController($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereDependsOnSettingItem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereNeedDividerAftter($value)
 * @mixin \Eloquent
 * @property bool $NeedDividerBefore
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereNeedDividerBefore($value)
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereDeletedBy($value)
 * @property-read \App\Models\Menu $menu
 */
class MenuItem extends Base\MenuItem {
	//
}

