<?php
namespace App\Models;

/**
 * App\Models\Breed
 *
 * @property string $Id
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property string $Name
 * @property string $SizeId
 * @property float|null $MinWeight
 * @property float|null $MaxWeight
 * @property int|null $ExternalId
 * @property-read \App\Models\BreedSize $breedSize
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BreederBreed[] $breederBreeds
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Form[] $forms
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Response[] $responses
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breed query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breed whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breed whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breed whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breed whereMaxWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breed whereMinWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breed whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breed whereSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breed whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breed whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breed whereDeletedBy($value)
 */
class Breed extends Base\Breed {
	//
}

