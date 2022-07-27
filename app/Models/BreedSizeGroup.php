<?php
namespace App\Models;

/**
 * App\Models\BreedSizeGroup
 *
 * @property string $Id
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property string|null $Mnemonic
 * @property int $Scheme3Limit
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BreedSize[] $breedSizes
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSizeGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSizeGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSizeGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSizeGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSizeGroup whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSizeGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSizeGroup whereMnemonic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSizeGroup whereScheme3Limit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSizeGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSizeGroup whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSizeGroup whereDeletedBy($value)
 */
class BreedSizeGroup extends Base\BreedSizeGroup {
	//
}

