<?php
namespace App\Models;

/**
 * App\Models\BreedersPlus
 *
 * @property string $Id
 * @property int $BreederId
 * @property string $IssueDate Дата выдачи
 * @property string|null $Comments
 * @property string|null $DeletedDate
 * @property string|null $DeletedUser
 * @property string $CreatedDate
 * @property string $Author
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedersPlus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedersPlus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedersPlus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedersPlus whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedersPlus whereBreederId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedersPlus whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedersPlus whereCreatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedersPlus whereDeletedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedersPlus whereDeletedUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedersPlus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedersPlus whereIssueDate($value)
 * @mixin \Eloquent
 * @property string|null $DeletedAt
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedersPlus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedersPlus whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedersPlus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BreedersPlus whereDeletedBy($value)
 */
class BreedersPlus extends Base\BreedersPlus {
	//
}

