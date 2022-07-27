<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BreederNotification extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'BreederNotifications';
    protected $fillable = ['Id', 'Subject', 'Text', 'BreederId', 'CreatedAt', 'ReadDate', 'DeletedAt'];


    public function breeder() {
        return $this->belongsTo(\App\Models\Breeder::class, 'BreederId', 'Id');
    }


}
