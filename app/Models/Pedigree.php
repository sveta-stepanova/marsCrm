<?php
namespace App\Models;

/**
 * App\Models\Pedigree
 *
 * @property string $Id
 * @property string|null $BreederId
 * @property string|null $FileName
 * @property string|null $FileExt
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedigree newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedigree newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedigree query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedigree whereBreederId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedigree whereFileExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedigree whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedigree whereId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Breeder|null $breeder
 */
class Pedigree extends Base\Pedigree {
	//
}

