<?php
namespace App\Models;

/**
 * App\Models\UsersLog
 *
 * @property int $Id
 * @property string|null $UserName
 * @property string|null $Password
 * @property string|null $Ip
 * @property string|null $CreatedDate
 * @property string|null $ReturnUrl
 * @property string|null $Result
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersLog whereCreatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersLog whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersLog wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersLog whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersLog whereReturnUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersLog whereUserName($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $CreatedAt
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersLog whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersLog whereDeletedBy($value)
 */
class UsersLog extends Base\UsersLog {
	//
}

