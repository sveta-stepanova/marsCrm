<?php
namespace App\Models;

/**
 * App\Models\FiasLevel
 *
 * @property string $Id
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property string $Name
 * @property float|null $Level
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FiasLevel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FiasLevel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FiasLevel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FiasLevel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FiasLevel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FiasLevel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FiasLevel whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FiasLevel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FiasLevel whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FiasLevel whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FiasLevel whereDeletedBy($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Fias[] $fias
 */
class FiasLevel extends Base\FiasLevel {
	const LEVEL_ID_FEDERAL = 1; // Субъект федерации
	const LEVEL_ID_REGION = 3; // Район, улус
	const LEVEL_ID_MACRO = 0; // Макрорегион
	const LEVEL_ID_CITY = 4; // Населенный пункт
}


