<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Base\WorkGroupStaff
 *
 * @property int $Id Id
 * @property int $WorkGroupId Id рабочей группы
 * @property string|null $StaffId Id сотрудника
 * @property bool $ViewAllGroupProjects
 * @property string $Author Автор
 * @property \Illuminate\Support\Carbon $CreatedAt Дата создания
 * @property string $CreatedBy
 * @property-read \App\Models\Staff|null $staff
 * @property-read \App\Models\WorkGroup $workGroup
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\WorkGroupStaff newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\WorkGroupStaff newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\WorkGroupStaff query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\WorkGroupStaff whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\WorkGroupStaff whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\WorkGroupStaff whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\WorkGroupStaff whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\WorkGroupStaff whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\WorkGroupStaff whereViewAllGroupProjects($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\WorkGroupStaff whereWorkGroupId($value)
 * @mixin \Eloquent
 */
class WorkGroupStaff extends AbstractTable {

    /**
     * Generated
     */

    protected $table = 'WorkGroupStaffs';
    protected $fillable = ['Id', 'WorkGroupId', 'StaffId', 'ViewAllGroupProjects', 'Author', 'CreatedAt', 'CreatedBy'];


    public function workGroup() {
        return $this->belongsTo(\App\Models\WorkGroup::class, 'WorkGroupId', 'Id');
    }

    public function staff() {
        return $this->belongsTo(\App\Models\Staff::class, 'StaffId', 'Id');
    }


}
