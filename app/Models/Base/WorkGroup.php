<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Base\WorkGroup
 *
 * @property int $Id Id
 * @property int|null $ParentId
 * @property string $HeaderId Руковадитель
 * @property string $Name Название
 * @property string $Author Автор
 * @property string|null $DeletedAt Дата удаления
 * @property string|null $DeletedBy
 * @property \Illuminate\Support\Carbon $CreatedAt Дата создания
 * @property string $CreatedBy
 * @property-read \App\Models\Staff $header
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Staff[] $staff
 * @property-read \App\Models\WorkGroup|null $workGroup
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WorkGroupStaff[] $workGroupStaffs
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WorkGroup[] $workGroups
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\WorkGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\WorkGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Base\WorkGroup onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\WorkGroup query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\WorkGroup whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\WorkGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\WorkGroup whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\WorkGroup whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\WorkGroup whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\WorkGroup whereHeaderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\WorkGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\WorkGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\WorkGroup whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Base\WorkGroup withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Base\WorkGroup withoutTrashed()
 * @mixin \Eloquent
 */
class WorkGroup extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'WorkGroups';
    protected $fillable = ['Id', 'ParentId', 'HeaderId', 'Name', 'Author', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function header() {
        return $this->belongsTo(\App\Models\Staff::class, 'HeaderId', 'Id');
    }

    public function workGroup() {
        return $this->belongsTo(\App\Models\WorkGroup::class, 'ParentId', 'Id');
    }

    public function staff() {
        return $this->belongsToMany(\App\Models\Staff::class, 'WorkGroupStaffs', 'WorkGroupId', 'StaffId');
    }

    public function workGroups() {
        return $this->hasMany(\App\Models\WorkGroup::class, 'ParentId', 'Id');
    }

    public function workGroupStaffs() {
        return $this->hasMany(\App\Models\WorkGroupStaff::class, 'WorkGroupId', 'Id');
    }


}
