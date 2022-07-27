<?php

namespace App\Models;

/**
 * App\Models\Staff
 *
 * @property string $Id
 * @property int|null $UserId
 * @property string $Email
 * @property string $Name
 * @property string|null $Phone
 * @property string|null $DismissDate
 * @property string|null $DismissUser
 * @property string|null $DeletedDate
 * @property string|null $DeletedUser
 * @property string $CreatedDate
 * @property string $Author
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff whereCreatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff whereDeletedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff whereDeletedUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff whereDismissDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff whereDismissUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff whereUserId($value)
 * @mixin \Eloquent
 * @property int|null $ImportManagerId
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff whereImportManagerId($value)
 * @property string|null $DeletedAt
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff whereDeletedBy($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Breeder[] $approvedBreeders
 * @property-read \App\Models\AspNetUser|null $aspNetUser
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Form[] $checkedOutForms
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Fias[] $fias
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Breeder[] $managedBreeders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RegionManager[] $regionManagers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Form[] $validatedForms
 */
class Staff extends Base\Staff {

    public static function managers() {
        $managers = Staff::query();
        $managers->leftJoin('AspNetUsers', 'AspNetUsers.Id', '=', 'Staffs.UserId');
        $managers->leftJoin('AspNetUserRoles', 'AspNetUserRoles.UserId', '=', 'AspNetUsers.Id');
        $managers->where('RoleId', 400);
        return $managers->select('Staffs.*', 'AspNetUsers.UserName');
    }

}
