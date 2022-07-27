<?php
namespace App\Models;

use App\Brands\AbstractBrand;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\AspNetUser
 *
 * @property int $Id
 * @property string|null $Email
 * @property bool $EmailConfirmed
 * @property string|null $PasswordHash
 * @property string|null $SecurityStamp
 * @property string|null $PhoneNumber
 * @property bool $PhoneNumberConfirmed
 * @property bool $TwoFactorEnabled
 * @property string|null $LockoutEndDateUtc
 * @property bool $LockoutEnabled
 * @property int $AccessFailedCount
 * @property string $UserName
 * @property string|null $Name
 * @property string|null $DeletedDate Дата удаления
 * @property string|null $DeletedUser
 * @property string $CreatedDate Дата создания
 * @property string $Author
 * @property int|null $SourceId
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser whereAccessFailedCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser whereCreatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser whereDeletedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser whereDeletedUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser whereEmailConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser whereLockoutEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser whereLockoutEndDateUtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser wherePasswordHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser wherePhoneNumberConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser whereSecurityStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser whereTwoFactorEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser whereUserName($value)
 * @mixin \Eloquent
 * @property string|null $DeletedAt Дата удаления
 * @property \Illuminate\Support\Carbon $CreatedAt Дата создания
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser whereDeletedBy($value)
 * @property string|null $remember_token
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AspNetRole[] $aspNetRoles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AspNetUserClaim[] $aspNetUserClaims
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AspNetUserLogin[] $aspNetUserLogins
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AspNetUserRole[] $aspNetUserRoles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Breeder[] $breeders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Staff[] $staff
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AspNetUser whereRememberToken($value)
 */
class AspNetUser extends Base\AspNetUser implements Authenticatable {

	use \Illuminate\Auth\Authenticatable;

	public function getAuthIdentifierName() {
		return 'Id';
	}

	public function externalOperatorAuthAttempt(string $password, string $remoteAddr, bool $doLogin = true): bool {
		/** @var AbstractBrand $brand */
		$brand = App::make(AbstractBrand::class);
		$url = $brand->getOperatorAuthUrl();
		$request = ['UserName' => $this->UserName, 'Password' => $password, 'RemoteAdr' => $remoteAddr];
		$client = new Client();
		$reply = $client->post($url, [
			RequestOptions::HEADERS => ['Content-Type' => 'application/json'],
			RequestOptions::BODY => json_encode($request),
			RequestOptions::HTTP_ERRORS => false,
		]);
		switch ($reply->getStatusCode()) {
			case 400:
				return false;
			case 200:
				if ($doLogin) {
					Auth::login($this);
				}
				return true;
			default:
				throw new \Exception('Invalid auth service reply: ' . $reply->getStatusCode());
		}
	}

	protected function serverGeneratedId(): bool {
		return true;
	}

}


