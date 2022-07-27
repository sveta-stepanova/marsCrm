<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Base\ValidationStatus
 *
 * @property string $Id
 * @property int $NumericId
 * @property string $Name
 * @property bool $IsValid
 * @property string|null $Description
 * @property string|null $Mnemonic
 * @property bool $SetManually
 * @property string|null $DeletedAt
 * @property string|null $DeletedBy
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property string $CreatedBy
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Form[] $forms
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\ValidationStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\ValidationStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Base\ValidationStatus onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\ValidationStatus query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\ValidationStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\ValidationStatus whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\ValidationStatus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\ValidationStatus whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\ValidationStatus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\ValidationStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\ValidationStatus whereIsValid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\ValidationStatus whereMnemonic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\ValidationStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\ValidationStatus whereNumericId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\ValidationStatus whereSetManually($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Base\ValidationStatus withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Base\ValidationStatus withoutTrashed()
 * @mixin \Eloquent
 */
class ValidationStatus extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'ValidationStatus';
    protected $fillable = ['Id', 'NumericId', 'Name', 'IsValid', 'Description', 'Mnemonic', 'SetManually', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function forms() {
        return $this->hasMany(\App\Models\Form::class, 'StatusId', 'Id');
    }


}
