<?php
/**
 * Created by PhpStorm.
 * User: muto
 * Date: 01.08.17
 * Time: 18:16
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

/**
 * Class AbstractTable
 * @package App\Models\Base
 * @method static static findOrFail($id)
 */
abstract class AbstractTable extends Model {

	const CREATED_AT = 'CreatedAt';
	const UPDATED_AT = null;
	const DELETED_AT = 'DeletedAt';

	protected $primaryKey = 'Id';
	public $incrementing = false;
	public $timestamps = true;
	protected $dateFormat = 'Y-m-d H:i:s';

	protected static function boot() {
		parent::boot();
		static::creating(function($model){
			if (!$model->Id && !$model->serverGeneratedId()) {
				$model->Id = Uuid::uuid4();
			}
		});
		static::created(function($model){
			if (!$model->Id && $model->serverGeneratedId()) {
				$model->Id = DB::select('SELECT CAST(SCOPE_IDENTITY() AS INT) AS id')[0]->id;
			}
		});
	}

	protected function serverGeneratedId(): bool {
		return false;
	}

	public function scopeNoLock($query) {
		return $query->from(DB::raw(self::getTable() . ' WITH (NOLOCK)'));
	}
	/*
	public function getCreatedAtAttribute($value) {
		return new Carbon($value);
	}
	public function getUpdatedAtAttribute($value) {
		return new Carbon($value);
	}
	public function getDeletedAtAttribute($value) {
		return new Carbon($value);
	}
	*/
	public static function getTableStatic() {
		return (new static())->getTable();
	}

	public function updateFromRequest(Request $request, array $fieldsList = null) {
		if (is_null($fieldsList)) {
			$fieldsList = $this->fillable;
		}
		foreach ($fieldsList as $field) {
			if (in_array($field, $this->fillable)) {
				$this->$field = $request->$field;
			}
		}
	}

}
