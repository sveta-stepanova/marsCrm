<?php
namespace App\Models;

/**
 * App\Models\RoleRight
 *
 * @property int $Id Id
 * @property int|null $RoleId Id Роли
 * @property int|null $RightId Id права
 * @property string $CreatedDate Дата создания
 * @property string $Author Автор
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleRight newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleRight newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleRight query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleRight whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleRight whereCreatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleRight whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleRight whereRightId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleRight whereRoleId($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon $CreatedAt Дата создания
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleRight whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleRight whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleRight whereDeletedBy($value)
 * @property-read \App\Models\AspNetRole|null $aspNetRole
 * @property-read \App\Models\Right|null $right
 */
class RoleRight extends Base\RoleRight {
	//
}

