<?php
namespace App\Models;

/**
 * App\Models\ValidationStatus
 *
 * @property string $Id
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property int $NumericId
 * @property string $Name
 * @property bool $IsValid
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Form[] $forms
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ValidationStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ValidationStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ValidationStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ValidationStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ValidationStatus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ValidationStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ValidationStatus whereIsValid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ValidationStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ValidationStatus whereNumericId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ValidationStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $Description
 * @property string|null $Mnemonic
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ValidationStatus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ValidationStatus whereMnemonic($value)
 * @property bool $SetManually
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ValidationStatus whereSetManually($value)
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ValidationStatus whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ValidationStatus whereDeletedBy($value)
 */
class ValidationStatus extends Base\ValidationStatus {
	// SELECT 'const STATUS_ID_' + UPPER(Mnemonic) + ' = ''' + CAST(Id AS NVARCHAR(100)) + ''';' FROM ValidationStatus
	const STATUS_ID_DUPLICATE = '4CC39C07-0C41-4574-A6F8-1F40AD6A644A';
	const STATUS_ID_MULTIPLEORDERS = '58815E4B-0E5F-4E19-9083-2DCFC0C5C73C';
	const STATUS_ID_NOTFORMS = 'CA105538-BECA-49B0-A1B7-788CA13D74B8';
	const STATUS_ID_VALID = '7553B0B2-2917-4B38-A2EB-93CAE3B265F4';
	const STATUS_ID_INVALID = '42FDBE30-FFA4-449E-8572-9919D528ACA8';
	const STATUS_ID_NULL = '03EE74A7-7631-4A8B-BCBC-C9288A67912C';
	const STATUS_ID_FILEINVALID = '61F8AA1A-4484-44A8-8D09-CC641DD32249';
	const STATUS_ID_TEXTUNREADABLE = '85E29C5C-21EC-4108-87B3-D1D904B21EB5';
}

