<?php
namespace App\Models;

/**
 * App\Models\RightsGroup
 *
 * @property int $Id Id
 * @property string $Name Название
 * @property string|null $Controller Controller
 * @property bool $IsAutoGenerated АвтоГенерация
 * @property bool $Excluded Исключен
 * @property bool $ExcludedInClientPlace Исключен на продакшене
 * @property string|null $DeletedDate Дата удаления
 * @property string|null $CreatedDate Дата создания
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RightsGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RightsGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RightsGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RightsGroup whereController($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RightsGroup whereCreatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RightsGroup whereDeletedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RightsGroup whereExcluded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RightsGroup whereExcludedInClientPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RightsGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RightsGroup whereIsAutoGenerated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RightsGroup whereName($value)
 * @mixin \Eloquent
 * @property string|null $DeletedAt Дата удаления
 * @property \Illuminate\Support\Carbon|null $CreatedAt Дата создания
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RightsGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RightsGroup whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RightsGroup whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RightsGroup whereDeletedBy($value)
 */
class RightsGroup extends Base\RightsGroup {
	//
}

