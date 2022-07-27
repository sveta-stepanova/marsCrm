<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BreedersPlus extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'BreedersPlus';
    protected $fillable = ['Id', 'KeyId', 'BreederId', 'IssueDate', 'Comments', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy'];


    public function breeder() {
        return $this->belongsTo(\App\Models\Breeder::class, 'BreederId', 'Id');
    }

    public function emails() {
        return $this->hasMany(\App\Models\Email::class, 'BreederPlusId', 'Id');
    }


}
