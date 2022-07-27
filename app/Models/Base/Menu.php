<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class Menu extends AbstractTable {

    /**
     * Generated
     */

    protected $table = 'Menu';
    protected $fillable = ['Id', 'Name', 'IsActive'];


    public function menuItems() {
        return $this->hasMany(\App\Models\MenuItem::class, 'MenuId', 'Id');
    }


}
