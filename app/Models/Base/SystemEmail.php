<?php namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Base\SystemEmail
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\SystemEmail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\SystemEmail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AbstractTable noLock()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\SystemEmail query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\SystemEmail whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\SystemEmail whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\SystemEmail whereCreatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\SystemEmail whereFailedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\SystemEmail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\SystemEmail whereResultMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\SystemEmail whereSendedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\SystemEmail whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\SystemEmail whereToEmail($value)
 * @mixin \Eloquent
 */
class SystemEmail extends AbstractTable {

    /**
     * Generated
     */

    protected $table = 'SystemEmails';
    protected $fillable = ['Id', 'ToEmail', 'Subject', 'Body', 'CreatedDate', 'SendedDate', 'FailedDate', 'ResultMessage', 'Author'];



}
