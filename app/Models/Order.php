<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Breed;

/**
 * App\Models\Order
 *
 * @property string $Id
 * @property string $BreederId
 * @property string|null $BreederBreedId
 * @property int|null $OrderId Id заказа в базе Конвергента
 * @property int|null $PetCount
 * @property int|null $PrizeCount
 * @property int|null $DryBabyCount
 * @property int|null $PouchCount
 * @property string|null $LitterDate
 * @property string|null $SupplyDate
 * @property string|null $CreateWhen
 * @property int|null $MilkyPocketsCountSmall
 * @property int|null $MilkyPocketsCountMedium
 * @property int|null $MilkyPocketsCountLarge
 * @property string|null $PetBreed
 * @property float|null $PetWeight
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereBreederBreedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereBreederId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreateWhen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDryBabyCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereLitterDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereMilkyPocketsCountLarge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereMilkyPocketsCountMedium($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereMilkyPocketsCountSmall($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePetBreed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePetCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePetWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePouchCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePrizeCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereSupplyDate($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDeletedBy($value)
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @property int|null $DrySmallCount
 * @property int|null $DryLargeCount
 * @property string $DeletedAt
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDryLargeCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDrySmallCount($value)
 */
class Order extends Base\Order {

    public function orderDeliveryDate(string $litterDate) {
        $litterDate = Carbon::parse($litterDate);
        if (Carbon::now() >= $litterDate->format('Y-m-d') && Carbon::now() < (clone $litterDate)->addDays(15)) {
            return $litterDate->addDays(21);
        } 
        if (Carbon::now() >= (clone $litterDate)->addDays(15) && Carbon::now() < (clone $litterDate)->addDays(22)) {
            return $litterDate->addDays(28);
        } else {
            throw new \Exception('Invalid litter date');
        }
    }
    
    public function breeder() {
        return $this->belongsTo(\App\Models\Breeder::class, 'BreederId', 'Id')->withTrashed();
    }

    public function orderPackageCount(string $mnemonic) {
        if ($mnemonic == 'XS') {
            return 5;
        }
        if (in_array($mnemonic, ['S', 'M'])) {
            return 8;
        }
        return 12;
    }

}
