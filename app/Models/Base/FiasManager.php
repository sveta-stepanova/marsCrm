<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Base\FiasManager
 *
 * @property string $Id
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property string|null $DeletedAt
 * @property string $ManagerId
 * @property string $FiasId
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @property-read \App\Models\Staff $createdByUser
 * @property-read \App\Models\Staff $deletedByUser
 * @property-read \App\Models\Fias $fias
 * @property-read \App\Models\Staff $staff
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FiasManager newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FiasManager newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Base\FiasManager onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FiasManager query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FiasManager whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FiasManager whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FiasManager whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FiasManager whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FiasManager whereFiasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FiasManager whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\FiasManager whereManagerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Base\FiasManager withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Base\FiasManager withoutTrashed()
 * @mixin \Eloquent
 */
class FiasManager extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'FiasManagers';
    protected $fillable = ['Id', 'CreatedAt', 'DeletedAt', 'ManagerId', 'FiasId', 'CreatedBy', 'DeletedBy'];


    public function staff() {
        return $this->belongsTo(\App\Models\Staff::class, 'ManagerId', 'Id');
    }

    public function fias() {
        return $this->belongsTo(\App\Models\Fias::class, 'FiasId', 'Id');
    }

    public function createdByUser() {
        return $this->belongsTo(\App\Models\Staff::class, 'CreatedBy', 'Id');
    }

    public function deletedByUser() {
        return $this->belongsTo(\App\Models\Staff::class, 'DeletedBy', 'Id');
    }


}
