<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Form
 *
 * @property string $Id
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property string $BreederId
 * @property string|null $RemoteURL
 * @property string|null $LocalFile
 * @property string $ExternalId
 * @property string|null $CheckedOutAt
 * @property string|null $CheckedOutBy
 * @property string|null $ValidatedAt
 * @property string|null $ValidatedBy
 * @property string $StatusId
 * @property-read \App\Models\Breeder $breeder
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Breed[] $breeds
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Response[] $responses
 * @property-read \App\Models\ValidationStatus $validationStatus
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereBreederId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereCheckedOutAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereCheckedOutBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereLocalFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereRemoteURL($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereValidatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereValidatedBy($value)
 * @mixin \Eloquent
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereDeletedBy($value)
 * @property-read \App\Models\Staff|null $checkedOutByOperator
 * @property-read \App\Models\Staff|null $validatedByOperator
 * @property string $OrderId Номер заказа у конвергента
 * @property int $FormStateId
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereFormStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form whereOrderId($value)
 */
class Form extends Base\Form {

	const CHECKOUT_LIFETIME = 60; // minutes

	public static function toBeProcessed(?Staff $operator = null): Builder {
		$builder = self
			::where(['ValidatedBy' => null, 'CheckedOutBy' => null])
			->orWhere(function(Builder $builder){
				$builder->whereNull('ValidatedBy')
					->whereNotNull('CheckedOutBy')
					->where('CheckedOutAt', '<', Carbon::now()->subMinutes(self::CHECKOUT_LIFETIME));
			});
		if ($operator) {
			$builder->orWhere(function(Builder $builder) use($operator){
				$builder->where(['ValidatedBy' => null, 'CheckedOutBy' => $operator->Id]);
			});
		}
		$builder->orderBy('CreatedAt');

		return $builder;
	}

	public function checkout(Staff $operator): void {
		// todo: transaction & exclusive lock (to prevent checking out by several operators at the same moment)
		$this->CheckedOutAt = Carbon::now();
		$this->CheckedOutBy = $operator->Id;
		$this->save();
	}

	public function isCheckedOut(Staff $byOperator): bool {
		if ($this->ValidatedBy || $this->ValidatedAt) {
			return false;
		}
		return $this->CheckedOutBy == $byOperator->Id
			&& $this->CheckedOutAt > Carbon::now()->subMinutes(self::CHECKOUT_LIFETIME);
	}

	public function imageFileName() {
		return storage_path('app/external/forms/' . $this->LocalFile);
	}

}

