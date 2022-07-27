<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends AbstractTable {

    /**
     * Generated
     */

    protected $table = 'MenuItems';
    protected $fillable = ['Id', 'MenuId', 'Name', 'Controller', 'Action', 'DependsOnSettingItem', 'NeedDividerBefore', 'IsActive'];


    public function menu() {
        return $this->belongsTo(\App\Models\Menu::class, 'MenuId', 'Id');
    }


}
