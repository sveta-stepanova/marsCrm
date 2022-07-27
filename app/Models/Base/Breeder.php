<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Breeder extends AbstractTable {

    /**
     * Generated
     */

    use SoftDeletes;
    const DELETED_AT = 'DeletedAt';

    protected $table = 'Breeders';
    protected $fillable = ['Id', 'UID', 'LastName', 'FirstName', 'Patronymic', 'Email', 'Phone', 'BirthDate', 'NurseryName', 'NurseryPhone', 'ManagerId', 'RegionDealerId', 'NurseryRegionId', 'NurseryCityId', 'NurseryCityDistrictId', 'NurseryStreet', 'NurseryHouse', 'NurseryBuild', 'NurseryFlat', 'SchemaId', 'ApprovedAt', 'ApprovedBy', 'SapId', 'ReportPeriodStart', 'ReportPeriodEnd', 'CCValue', 'CCBlocked', 'CCLastCheckedAt', 'CCLastUpdatedAt', 'YearEstimatedCalories', 'RPEstimatedCalories', 'RPOrderedCalories', 'BreederStatusId', 'StatusUpdatedAt', 'FCIRegistrationDate', 'RegCertificateNum', 'Limit', 'BroodFemalesCount', 'IsBlocked', 'ReportedAt', 'PrizeCount', 'PrizeBreed', 'TermsAccepted', 'DeletedAt', 'DeletedBy', 'CreatedAt', 'CreatedBy', 'Fio', 'UserId', 'RulesAccepted', 'AgreeAdvertInfo', 'Agree18'];


    public function aspNetUser() {
        return $this->belongsTo(\App\Models\AspNetUser::class, 'UserId', 'Id');
    }

    public function breederStatus() {
        return $this->belongsTo(\App\Models\BreederStatus::class, 'BreederStatusId', 'Id');
    }

    public function manager() {
        return $this->belongsTo(\App\Models\Staff::class, 'ManagerId', 'Id');
    }

    public function approvedByManager() {
        return $this->belongsTo(\App\Models\Staff::class, 'ApprovedBy', 'Id');
    }

    public function regionDealer() {
        return $this->belongsTo(\App\Models\RegionDealer::class, 'RegionDealerId', 'Id');
    }

    public function schema() {
        return $this->belongsTo(\App\Models\Schema::class, 'SchemaId', 'Id');
    }

    public function nurseryRegion() {
        return $this->belongsTo(\App\Models\Fias::class, 'NurseryRegionId', 'Id');
    }

    public function nurseryCity() {
        return $this->belongsTo(\App\Models\Fias::class, 'NurseryCityId', 'Id');
    }

    public function nurseryCityDistrict() {
        return $this->belongsTo(\App\Models\Fias::class, 'NurseryCityDistrictId', 'Id');
    }

    public function bonusProducts() {
        return $this->hasMany(\App\Models\BonusProduct::class, 'BreederId', 'Id');
    }

    public function breederBreeds() {
        return $this->hasMany(\App\Models\BreederBreed::class, 'BreederId', 'Id');
    }

    public function breederNotifications() {
        return $this->hasMany(\App\Models\BreederNotification::class, 'BreederId', 'Id');
    }

    public function breedersPluses() {
        return $this->hasMany(\App\Models\BreedersPlus::class, 'BreederId', 'Id');
    }

    public function breedersPlusAgrees() {
        return $this->hasMany(\App\Models\BreedersPlusAgree::class, 'BreederId', 'Id');
    }

    public function breederSupports() {
        return $this->hasMany(\App\Models\BreederSupport::class, 'BreederId', 'Id');
    }

    public function forms() {
        return $this->hasMany(\App\Models\Form::class, 'BreederId', 'Id');
    }

    public function orderedProducts() {
        return $this->hasMany(\App\Models\OrderedProduct::class, 'BreederId', 'Id');
    }

    public function orders() {
        return $this->hasMany(\App\Models\Order::class, 'BreederId', 'Id');
    }

    public function pedigrees() {
        return $this->hasMany(\App\Models\Pedigree::class, 'BreederId', 'Id');
    }


}
