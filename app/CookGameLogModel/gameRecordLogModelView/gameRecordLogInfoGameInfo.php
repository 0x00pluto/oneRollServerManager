<?php
/**
 * Created by PhpStorm.
 * User: liuruitao
 * Date: 2015/11/17
 * Time: 15:09
 */

namespace App\CookGameLogModel\gameRecordLogModelView;


class gameRecordLogInfoGameInfo
{
    /**
     * 游戏详细信息
     * @var array
     */
    protected $gameRecordInfo;

    /**
     * @param array $context
     */
    public function __construct(array $context)
    {
        $this->gameRecordInfo = $context;
    }

    /**
     * 获取简短描述
     * @return string
     */
    public function getShortDescription()
    {
        return "";
    }

}