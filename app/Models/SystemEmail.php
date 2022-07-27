<?php
namespace App\Models;

/**
 * App\Models\SystemEmail
 *
 * @property int $Id Id
 * @property string $ToEmail Email
 * @property string $Subject
 * @property string $Body
 * @property string $CreatedDate Дата создания
 * @property string|null $SendedDate
 * @property string|null $FailedDate Дата ошибки
 * @property string|null $ResultMessage Текст ошибки
 * @property string|null $Author Автор
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SystemEmail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SystemEmail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SystemEmail query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SystemEmail whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SystemEmail whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SystemEmail whereCreatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SystemEmail whereFailedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SystemEmail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SystemEmail whereResultMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SystemEmail whereSendedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SystemEmail whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SystemEmail whereToEmail($value)
 * @mixin \Eloquent
 */
class SystemEmail extends Base\SystemEmail {
	//
}

