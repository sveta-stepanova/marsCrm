<?php
namespace App\Models;

/**
 * App\Models\WorkGroup
 *
 * @property int $Id Id
 * @property int|null $ParentId
 * @property string $HeaderId Руковадитель
 * @property string $Name Название
 * @property string|null $DeletedDate Дата удаления
 * @property string|null $DeletedUser Удалил
 * @property string $CreatedDate Дата создания
 * @property string $Author Автор
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroup whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroup whereCreatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroup whereDeletedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroup whereDeletedUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroup whereHeaderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroup whereParentId($value)
 * @mixin \Eloquent
 * @property string|null $DeletedAt Дата удаления
 * @property \Illuminate\Support\Carbon $CreatedAt Дата создания
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroup whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroup whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkGroup whereDeletedBy($value)
 * @property-read \App\Models\Staff $header
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Staff[] $staff
 * @property-read \App\Models\WorkGroup $workGroup
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WorkGroupStaff[] $workGroupStaffs
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WorkGroup[] $workGroups
 */
class WorkGroup extends Base\WorkGroup {
	//
}

