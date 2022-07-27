<?php
namespace App\Models;

/**
 * App\Models\FormState
 *
 * @property int $Id
 * @property string $Name
 * @property bool $IsValid
 * @property string|null $Description
 * @property string|null $Mnemonic
 * @property bool $SetManually
 * @property string|null $DeletedAt
 * @property string|null $DeletedBy
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property string $CreatedBy
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Form[] $forms
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormState newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormState newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormState query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormState whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormState whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormState whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormState whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormState whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormState whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormState whereIsValid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormState whereMnemonic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormState whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormState whereSetManually($value)
 * @mixin \Eloquent
 */
class FormState extends Base\FormState {
	const STATUS_ID_DUPLICATE = -6;
	const STATUS_ID_MULTIPLEORDERS = -4;
	const STATUS_ID_NOTFORMS = -3;
	const STATUS_ID_VALID = 1;
	const STATUS_ID_INVALID = -1;
	const STATUS_ID_NULL = 0;
	const STATUS_ID_FILEINVALID = -5;
	const STATUS_ID_TEXTUNREADABLE = -2;
}

