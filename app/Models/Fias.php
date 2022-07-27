<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * App\Models\Fias
 *
 * @property string $Id
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property string $Name
 * @property float $Level
 * @property string|null $ParentId
 * @property string|null $OriginalParentId
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Fias[] $fias
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FiasManager[] $fiasManagers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Manager[] $managers
 * @property-read \App\Models\Fias|null $parentRecord
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fias newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fias newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fias query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fias whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fias whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fias whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fias whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fias whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fias whereOriginalParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fias whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fias whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $FlatShortName
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fias whereFlatShortName($value)
 * @property string $FiasLevelId
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fias whereFiasLevelId($value)
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fias whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fias whereDeletedBy($value)
 * @property string|null $ShortName
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fias whereShortName($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Fias[] $childRecords
 * @property-read \App\Models\FiasLevel $fiasLevel
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RegionManager[] $regionManagers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Staff[] $staff
 */
class Fias extends Base\Fias {

	public static function regions(): Builder {
		return self::where(['FiasLevelId' => FiasLevel::LEVEL_ID_FEDERAL])->orderBy('Name');
	}

	public function cities(?string $pattern = null): Builder {
		$result = self
			// ::where(['FiasLevelId' => FiasLevel::LEVEL_ID_CITY])
			::whereIn('ShortName', self::cityShortNames())
			->where(function(Builder $builder){
				$builder
					->where(['ParentId' => $this->Id])
					->orWhere(['Id' => $this->Id])
					->orWhereIn('ParentId', $this->childRecords()->pluck('Id'));
			});
		if ($pattern) {
			$result->where('Name', 'LIKE', $pattern . '%');
		}
		return $result;
	}

	protected static function cityShortNames() {
		return [
			'с/п',			'г.',			'с/о',
			'тер',			'с/с',			'г',
			'пгт.',			'с/а',			'п',
			'с/мо',			'массив',		'пгт',
			'п/о',			'рп',			'дп',
		];
	}


}

