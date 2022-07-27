<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BreederSupport extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'BreederSupport';
    protected $fillable = ['Id', 'ParentId', 'Text', 'BreederId', 'StaffId', 'CreatedAt', 'DeletedAt'];


    public function breederSupport() {
        return $this->belongsTo(\App\Models\BreederSupport::class, 'ParentId', 'Id');
    }

    public function staff() {
        return $this->belongsTo(\App\Models\Staff::class, 'StaffId', 'Id');
    }

    public function breeder() {
        return $this->belongsTo(\App\Models\Breeder::class, 'BreederId', 'Id');
    }

    public function breederSupports() {
        return $this->hasMany(\App\Models\BreederSupport::class, 'ParentId', 'Id');
    }


}
