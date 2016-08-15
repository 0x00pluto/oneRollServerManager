<?php
/**
 * Created by PhpStorm.
 * User: liuruitao
 * Date: 2015/11/18
 * Time: 16:36
 */

namespace App\CookGameLogModel\gameRecordLogModelView;


class gameRecordLogInfoGameInfo_guide extends gameRecordLogInfoGameInfo
{
    /**
     * 获取开启，新手引导信息
     * @return string
     */
    public function getUserGuide(){
        return $this->gameRecordInfo['0'];
    }

}