<?php
namespace App\Models;

/**
 * App\Models\Email
 *
 * @property int $Id
 * @property int $MailingAccountId
 * @property string $EmailFrom
 * @property string $EmailTo
 * @property string|null $NameTo
 * @property string $Subject
 * @property string $Text
 * @property string $CreatedDate
 * @property string|null $SendDate
 * @property string|null $ReadDate
 * @property string|null $FailedDate
 * @property string|null $ResultMessage
 * @property string|null $OrderId
 * @property string|null $BonusProductId
 * @property string|null $BreederPlusId
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereBonusProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereBreederPlusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereCreatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereEmailFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereEmailTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereFailedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereMailingAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereNameTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereReadDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereResultMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereSendDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereText($value)
 * @mixin \Eloquent
 * @property string|null $NameFrom
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereNameFrom($value)
 * @property \Illuminate\Support\Carbon $CreatedAt
 * @property string $CreatedBy
 * @property string $DeletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereDeletedBy($value)
 */
class Email extends Base\Email {
	//
}

