<?php
namespace App\Models;

/**
 * App\Models\BreederBreed
 *
 * @property string $Id
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property string $BreederId
 * @property string $BreedId
 * @property int $TotalCount
 * @property float $AverageWeight
 * @property int|null $MonthlyFoodConsumption
 * @property-read \App\Models\Breed $breed
 * @property-read \App\Models\Breeder $breeder
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Breeder[] $breeders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FeedingOrder[] $feedingOrders
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederBreed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederBreed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederBreed query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederBreed whereAverageWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederBreed whereBreedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederBreed whereBreederId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederBreed whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederBreed whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederBreed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederBreed whereMonthlyFoodConsumption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederBreed whereTotalCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederBreed whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederBreed whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreederBreed whereDeletedBy($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 */
class BreederBreed extends Base\BreederBreed {
	//
}

