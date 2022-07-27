<?php
namespace App\Models;

/**
 * App\Models\ProductGroup
 *
 * @property string $Id
 * @property int|null $NumericId
 * @property string|null $Name
 * @property int|null $Scheme1Pack
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BonusProduct[] $bonusProducts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGroup whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGroup whereNumericId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGroup whereScheme1Pack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGroup whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductGroup whereDeletedBy($value)
 */
class ProductGroup extends Base\ProductGroup {
	//
}

