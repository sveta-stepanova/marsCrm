<?php
namespace App\Models;

/**
 * App\Models\AspNetRole
 *
 * @property int $Id
 * @property string $Name
 * @property string|null $DisplayName
 * @property string|null $Comments
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetRole whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetRole whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetRole whereName($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetRole whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetRole whereDeletedBy($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AspNetUserRole[] $aspNetUserRoles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AspNetUser[] $aspNetUsers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Right[] $rights
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RoleRight[] $roleRights
 */
class AspNetRole extends Base\AspNetRole {
	const BREEDER_ROLE = 100; // Id роли "Заводчик"
        const MANAGER_ROLE = 400; // Id роли "Менеджер"
}

