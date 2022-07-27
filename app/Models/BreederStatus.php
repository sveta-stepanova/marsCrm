<?php
namespace App\Models;

/**
 * App\Models\BreederStatus
 *
 * @property string $Id
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property int $NumericId
 * @property string $Name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Breeder[] $breeders
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederStatus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederStatus whereNumericId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederStatus whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederStatus whereDeletedBy($value)
 */
class BreederStatus extends Base\BreederStatus {
	//
}

