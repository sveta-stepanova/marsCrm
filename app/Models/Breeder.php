<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 * App\Models\Breeder
 *
 * @property string $Id
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property \Illuminate\Support\Carbon|null $UpdatedAt
 * @property string|null $DeletedAt
 * @property int $NumericId
 * @property string|null $LastName
 * @property string|null $FirstName
 * @property string|null $Patronymic
 * @property string|null $Email
 * @property string|null $Phone
 * @property string|null $ManagerId
 * @property string $RegionId
 * @property string $CityId
 * @property string|null $NurseryName
 * @property int|null $SchemaId
 * @property string|null $ApprovedAt
 * @property string|null $ApprovedBy
 * @property string|null $SapIds
 * @property string|null $ReportPeriodStart
 * @property string|null $ReportPeriodEnd
 * @property float|null $CCValue
 * @property bool|null $CCBlocked
 * @property string|null $CCLastCheckedAt
 * @property string|null $CCLastUpdatedAt
 * @property int|null $YearEstimatedCalories
 * @property int|null $RPEstimatedCalories
 * @property int|null $RPOrderedCalories
 * @property string $StatusId
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BonusProduct[] $bonusProducts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BreederBreed[] $breederBreeds
 * @property-read \App\Models\BreederStatus $breederStatus
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BreedersUpdateLog[] $breedersUpdateLogs
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FeedingOrder[] $feedingOrders
 * @property-read \App\Models\Fias $fiasCity
 * @property-read \App\Models\Fias $fiasRegion
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Form[] $forms
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderedProduct[] $orderedProducts
 * @property-read \App\Models\Schema|null $schema
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereCCBlocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereCCLastCheckedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereCCLastUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereCCValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereNumericId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereNurseryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder wherePatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereRPEstimatedCalories($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereRPOrderedCalories($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereReportPeriodEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereReportPeriodStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereSapIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereSchemaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereYearEstimatedCalories($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Breed[] $breeds
 * @property int $UID UID
 * @property string|null $BirthDate BreederDateOfBirth
 * @property string|null $NurseryPhone PIT_TELCODE, PIT_TEL
 * @property string|null $CityDistrictId CityDistrictId
 * @property string|null $Street PIT_STREET
 * @property string|null $House PIT_NUMH, PIT_NUMK
 * @property string|null $Flat PIT_NUMF
 * @property string|null $StatusUpdatedAt StatusChangedDate
 * @property string|null $RegCertificateNum REGNO
 * @property int|null $Limit LIMIT
 * @property int|null $BroodFemalesCount BroodFemalesCount
 * @property bool|null $IsBlocked IsBlocked
 * @property string|null $ReportedAt ReportedDate
 * @property int|null $PrizeCount PRIZE_COUNT
 * @property string|null $PrizeBreed PRIZE_BREED
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereBroodFemalesCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereCityDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereFlat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereHouse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereIsBlocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereNurseryPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder wherePrizeBreed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder wherePrizeCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereRegCertificateNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereReportedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereStatusUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereUID($value)
 * @property string $NurseryRegionId PIT_REG, REGION_NAME, IDREG
 * @property string|null $NurseryCityId PIT_CITY
 * @property string|null $NurseryCityDistrictId CityDistrictId
 * @property string|null $NurseryStreet PIT_STREET
 * @property string|null $NurseryHouse PIT_NUMH, PIT_NUMK
 * @property string|null $NurseryFlat PIT_NUMF
 * @property bool|null $TermsAccepted
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereNurseryCityDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereNurseryCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereNurseryFlat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereNurseryHouse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereNurseryRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereNurseryStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereTermsAccepted($value)
 * @property string $Fio
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereFio($value)
 * @property string|null $FCIRegistrationDate FCI (?), FCIRegistrationDate
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereFCIRegistrationDate($value)
 * @property int|null $SapId SapId
 * @property int $BreederStatusId
 * @property int|null $UserId For PerfectFit
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereBreederStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereSapId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereUserId($value)
 * @property bool|null $RulesAccepted
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Response[] $responses
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Breeder whereRulesAccepted($value)
 */
class Breeder extends Base\Breeder {

    const LIMIT_PET_ORDER = 12;

    public function breeds() {
        return $this
                        ->belongsToMany(\App\Models\Breed::class, 'BreederBreeds', 'BreederId', 'BreedId')
                        ->whereNull('BreederBreeds.DeletedAt');
    }

    public function hasAllData() {
        return !!DB::select('SELECT dbo.HasAllData(?) AS Has', [$this->Id])[0]->Has;
    }

    public function limitPetCount() {
        $limit = \DB::select('EXEC dbo.GetMaxCountPuppies @UserId = ?', [$this->UserId])[0];
        return $limit ? $limit->computed : 0;



        $limit = (int) $this->Limit;
        if ($this->forms()->count()) {
            foreach ($this->forms() as $form) {
                $limit += $form->responses()->where('Valid', 1)->count();
            }
        }
        if ($this->orders()->count()) {
            $limit = $limit - $this->orders()->sum('PetCount');
        }

        return $limit;
    }

    public function responses() {
        return $this->hasManyThrough(
                        Response::class, Form::class, 'BreederId', 'FormId', 'Id', 'Id'
        );
    }

    public function newNotifications() {
        return $this->breederNotifications()->where('ReadDate', null)->count();
    }

    public function getProcessedCount() {
        $responses = $this
                ->join('Forms', 'BreederId', '=', 'Breeders.Id')
                ->join('Responses', 'Responses.FormId', '=', 'Forms.Id')
                ->where('BreederId', $this->Id);

        return $responses->count();
    }

    public function getPendingCount() {
        $responses = $this
                ->join('Forms', 'BreederId', '=', 'Breeders.Id')
                ->where('ValidatedAt', null)
                ->where('BreederId', $this->Id);
        return $responses->count();
    }

    public function getResponsesCount() {
        $responses = $this
                ->join('Forms', 'BreederId', '=', 'Breeders.Id')
                ->join('Responses', 'Responses.FormId', '=', 'Forms.Id')
                ->where('Valid', 1)
                ->where('BreederId', $this->Id);

        return $responses->count();
    }

}
