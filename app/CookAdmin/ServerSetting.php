<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/4/27
 * Time: 下午2:05
 */

namespace App\CookAdmin;


class ServerSetting extends Model
{
    protected $table = 'serverSettings';

    protected $fillable = [
        'serverName',
        'serverHostName',
        'apiUrl'
    ];

    protected $primaryKey = 'serverHostName';
}