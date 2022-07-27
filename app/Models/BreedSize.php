<?php
namespace App\Models;

/**
 * App\Models\BreedSize
 *
 * @property string $Id
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property string|null $ExternalId
 * @property string $GroupId
 * @property string $Name
 * @property string|null $Mnemonic
 * @property-read \App\Models\BreedSizeGroup $breedSizeGroup
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Breed[] $breeds
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSize newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSize newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSize query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSize whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSize whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSize whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSize whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSize whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSize whereMnemonic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSize whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSize whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSize whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedSize whereDeletedBy($value)
 */
class BreedSize extends Base\BreedSize {
	//
}

