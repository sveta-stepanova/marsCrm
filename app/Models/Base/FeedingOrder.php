<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Base\FeedingOrder
 *
 * @property string $Id
 * @property string $BreederId
 * @property string $BreederBreedId
 * @property string $ExternalOrderId
 * @property string $OrderContents
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property string $CreatedBy
 * @property string|null $DeletedAt
 * @property string|null $DeletedBy
 * @property-read \App\Models\Breeder $breeder
 * @property-read \App\Models\BreederBreed $breederBreed
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FeedingOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FeedingOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Base\FeedingOrder onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FeedingOrder query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FeedingOrder whereBreederBreedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FeedingOrder whereBreederId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FeedingOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FeedingOrder whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FeedingOrder whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FeedingOrder whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FeedingOrder whereExternalOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FeedingOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FeedingOrder whereOrderContents($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Base\FeedingOrder withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Base\FeedingOrder withoutTrashed()
 * @mixin \Eloquent
 */
class FeedingOrder extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'FeedingOrders';
    protected $fillable = ['Id', 'BreederId', 'BreederBreedId', 'ExternalOrderId', 'OrderContents', 'CreatedAt', 'CreatedBy', 'DeletedAt', 'DeletedBy'];


    public function breeder() {
        return $this->belongsTo(\App\Models\Breeder::class, 'BreederId', 'Id');
    }

    public function breederBreed() {
        return $this->belongsTo(\App\Models\BreederBreed::class, 'BreederBreedId', 'Id');
    }


}
