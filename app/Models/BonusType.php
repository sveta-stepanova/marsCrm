<?php
namespace App\Models;

/**
 * App\Models\BonusType
 *
 * @property string $Id
 * @property string $Name
 * @property string|null $Mnemonic
 * @property int $Quantity
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BonusProduct[] $bonusProducts
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusType whereMnemonic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusType whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusType whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusType whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusType whereDeletedBy($value)
 */
class BonusType extends Base\BonusType {
	//
}

