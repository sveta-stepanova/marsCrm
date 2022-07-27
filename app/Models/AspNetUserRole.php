<?php
namespace App\Models;

/**
 * App\Models\AspNetUserRole
 *
 * @property int $UserId
 * @property int $RoleId
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserRole whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserRole whereUserId($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserRole whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserRole whereDeletedBy($value)
 * @property \Illuminate\Support\Carbon|null $CreatedAt
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserRole whereCreatedAt($value)
 */
class AspNetUserRole extends Base\AspNetUserRole {
	protected function serverGeneratedId(): bool {
		return true;
	}
}

