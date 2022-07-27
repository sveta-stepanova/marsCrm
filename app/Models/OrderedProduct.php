<?php
namespace App\Models;

/**
 * App\Models\OrderedProduct
 *
 * @property string $Id
 * @property string $BreederId
 * @property string $ProductId
 * @property string $OrderDate
 * @property int|null $Quantity
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BonusConfirmation[] $bonusConfirmations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BonusProduct[] $bonusProducts
 * @property-read \App\Models\Breeder $breeder
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderedProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderedProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderedProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderedProduct whereBreederId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderedProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderedProduct whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderedProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderedProduct whereOrderDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderedProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderedProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderedProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderedProduct whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderedProduct whereDeletedBy($value)
 */
class OrderedProduct extends Base\OrderedProduct {
	//
}

