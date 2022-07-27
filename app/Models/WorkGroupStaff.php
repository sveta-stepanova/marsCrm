<?php
namespace App\Models;

/**
 * App\Models\WorkGroupStaff
 *
 * @property int $Id Id
 * @property int $WorkGroupId Id рабочей группы
 * @property string|null $StaffId Id сотрудника
 * @property bool $ViewAllGroupProjects
 * @property string $CreatedDate Дата создания
 * @property string $Author Автор
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroupStaff newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroupStaff newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroupStaff query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroupStaff whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroupStaff whereCreatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroupStaff whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroupStaff whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroupStaff whereViewAllGroupProjects($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroupStaff whereWorkGroupId($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon $CreatedAt Дата создания
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroupStaff whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroupStaff whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroupStaff whereDeletedBy($value)
 * @property-read \App\Models\Staff $staff
 * @property-read \App\Models\WorkGroup $workGroup
 */
class WorkGroupStaff extends Base\WorkGroupStaff {
	//
}

