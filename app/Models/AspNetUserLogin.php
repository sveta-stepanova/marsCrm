<?php
namespace App\Models;

/**
 * App\Models\AspNetUserLogin
 *
 * @property string $LoginProvider
 * @property string $ProviderKey
 * @property int $UserId
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserLogin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserLogin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserLogin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserLogin whereLoginProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserLogin whereProviderKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserLogin whereUserId($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserLogin whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserLogin whereDeletedBy($value)
 * @property-read \App\Models\AspNetUser $aspNetUser
 */
class AspNetUserLogin extends Base\AspNetUserLogin {
	//
}

