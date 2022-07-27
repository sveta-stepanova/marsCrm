<?php
namespace App\Models;

/**
 * App\Models\BonusConfirmation
 *
 * @property string $Id
 * @property string $BonusId
 * @property string $OrderedProductId
 * @property int $Quantity
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property-read \App\Models\BonusProduct $bonusProduct
 * @property-read \App\Models\OrderedProduct $orderedProduct
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusConfirmation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusConfirmation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusConfirmation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusConfirmation whereBonusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusConfirmation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusConfirmation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusConfirmation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusConfirmation whereOrderedProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusConfirmation whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusConfirmation whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusConfirmation whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusConfirmation whereDeletedBy($value)
 */
class BonusConfirmation extends Base\BonusConfirmation {
	//
}

