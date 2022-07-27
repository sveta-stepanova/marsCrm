<?php

namespace App\Models;

/**
 * App\Models\Product
 *
 * @property string $Id
 * @property string|null $GroupId
 * @property string|null $Name
 * @property float|null $Weight
 * @property int|null $CalorificValue
 * @property string|null $VendorCode
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderedProduct[] $orderedProducts
 * @property-read \App\Models\ProductGroup|null $productGroup
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCalorificValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereVendorCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereWeight($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDeletedBy($value)
 */
class Product extends Base\Product {
    const PRODUCT_S = 'DB9748A7-77E8-4621-90F9-BB097A4B07E5';
    const PRODUCT_L = '2017D27C-24C8-4A31-B0A2-CCDB3DDC4F68';

    public function getProductForSize(string $mnemonic) {
        if (in_array($mnemonic, ['XS', 'S'])) {
            return $this->where('Id', self::PRODUCT_S)->first();
        }
        return $this->where('Id', self::PRODUCT_L)->first();
    }

}
