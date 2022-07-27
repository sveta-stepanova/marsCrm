<?php
namespace App\Models;

/**
 * App\Models\AspNetUserClaim
 *
 * @property int $Id
 * @property int $UserId
 * @property string|null $ClaimType
 * @property string|null $ClaimValue
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserClaim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserClaim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserClaim query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserClaim whereClaimType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserClaim whereClaimValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserClaim whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserClaim whereUserId($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserClaim whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUserClaim whereDeletedBy($value)
 * @property-read \App\Models\AspNetUser $aspNetUser
 */
class AspNetUserClaim extends Base\AspNetUserClaim {
	//
}

