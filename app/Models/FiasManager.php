<?php
namespace App\Models;

/**
 * App\Models\FiasManager
 *
 * @property string $Id
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property string $ManagerId
 * @property string $FiasId
 * @property-read \App\Models\Fias $fias
 * @property-read \App\Models\Manager $manager
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FiasManager newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FiasManager newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FiasManager query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FiasManager whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FiasManager whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FiasManager whereFiasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FiasManager whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FiasManager whereManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FiasManager whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FiasManager whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FiasManager whereDeletedBy($value)
 * @property-read \App\Models\Staff $createdByUser
 * @property-read \App\Models\Staff $deletedByUser
 * @property-read \App\Models\Staff $staff
 */
class FiasManager extends Base\FiasManager {
	//
}

