<?php
namespace App\Models;

/**
 * App\Models\BonusProduct
 *
 * @property string $Id
 * @property int $KeyId Нужно для нумерации продукции
 * @property string $BreederId
 * @property string $ProductGroupId
 * @property string $BonusTypeId
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property string|null $CompletedAt
 * @property string|null $DispatchedAt
 * @property string|null $DispatchedEditUser
 * @property string|null $DispatchedComments
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property string|null $CompletedSetAt
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BonusConfirmation[] $bonusConfirmations
 * @property-read \App\Models\BonusType $bonusType
 * @property-read \App\Models\Breeder $breeder
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderedProduct[] $orderedProducts
 * @property-read \App\Models\ProductGroup $productGroup
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusProduct whereBonusTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusProduct whereBreederId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusProduct whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusProduct whereCompletedSetAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusProduct whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusProduct whereDispatchedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusProduct whereDispatchedComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusProduct whereDispatchedEditUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusProduct whereKeyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusProduct whereProductGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusProduct whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusProduct whereDeletedBy($value)
 */
class BonusProduct extends Base\BonusProduct {
	//
}

