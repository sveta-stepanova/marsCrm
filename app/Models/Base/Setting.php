<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class Setting extends AbstractTable {

    /**
     * Generated
     */

    protected $table = 'Settings';
    protected $fillable = ['Id', 'RestPetPeriod', 'GeneratingOffers', 'MinDryWeight', 'MaxDryWeight', 'MinWetPack', 'MaxWetPack', 'OfferDiscountAllPets', 'ActionDiscountAllPets', 'BreederBreedsOnlyInForms'];



}
