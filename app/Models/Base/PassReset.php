<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PassReset extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'PassReset';
    protected $fillable = ['Id', 'Email', 'CreatedAt', 'UpdatedAt', 'DeletedAt'];



}
