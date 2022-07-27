<?php
namespace App\Models;

/**
 * App\Models\Setting
 *
 * @property int $Id
 * @property int $RestPetPeriod
 * @property bool $GeneratingOffers Активизировать создание офферов
 * @property float|null $MinDryWeight
 * @property float|null $MaxDryWeight
 * @property int|null $MinWetPack
 * @property int|null $MaxWetPack
 * @property bool $OfferDiscountAllPets Скидка  распространяется на всех питомцев участника, получившего оффер
 * @property bool $ActionDiscountAllPets Скидка распространяется на всех питомцев участника, учавствующего в акции
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereActionDiscountAllPets($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereGeneratingOffers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereMaxDryWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereMaxWetPack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereMinDryWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereMinWetPack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereOfferDiscountAllPets($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereRestPetPeriod($value)
 * @mixin \Eloquent
 * @property bool $BreederBreedsOnlyInForms
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereBreederBreedsOnlyInForms($value)
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereDeletedBy($value)
 */
class Setting extends Base\Setting {
	//
}

