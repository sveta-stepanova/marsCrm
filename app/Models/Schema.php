<?php
namespace App\Models;

/**
 * App\Models\Schema
 *
 * @property string $Id
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property int $NumericId
 * @property string|null $Name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Breeder[] $breeders
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schema newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schema newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schema query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schema whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schema whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schema whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schema whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schema whereNumericId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schema whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schema whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schema whereDeletedBy($value)
 * @property string $KeyId
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Schema whereKeyId($value)
 */
class Schema extends Base\Schema {
	//
}

