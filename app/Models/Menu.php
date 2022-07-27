<?php
namespace App\Models;

/**
 * App\Models\Menu
 *
 * @property int $Id Id
 * @property string $Name Название
 * @property bool $IsActive Активен
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereName($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereDeletedBy($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MenuItem[] $menuItems
 */
class Menu extends Base\Menu {
	//
}

