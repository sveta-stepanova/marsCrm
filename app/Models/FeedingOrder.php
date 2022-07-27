<?php
namespace App\Models;

/**
 * App\Models\FeedingOrder
 *
 * @property string $Id
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property string $BreederId
 * @property string $BreederBreedId
 * @property string $ExternalOrderId
 * @property string $OrderContents
 * @property-read \App\Models\Breeder $breeder
 * @property-read \App\Models\BreederBreed $breederBreed
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeedingOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeedingOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeedingOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeedingOrder whereBreederBreedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeedingOrder whereBreederId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeedingOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeedingOrder whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeedingOrder whereExternalOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeedingOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeedingOrder whereOrderContents($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeedingOrder whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeedingOrder whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeedingOrder whereDeletedBy($value)
 */
class FeedingOrder extends Base\FeedingOrder {
	//
}

