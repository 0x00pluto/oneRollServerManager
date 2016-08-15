<?php
/**
 * Created by PhpStorm.
 * User: liuruitao
 * Date: 2015/11/18
 * Time: 16:34
 */

namespace App\CookGameLogModel\gameRecordLogModelView;


class gameRecordLogInfoGameInfo_diamondOrCoin extends gameRecordLogInfoGameInfo
{
    /**
     * 获取总数
     * @return int
     */
    public function getNum(){
        return $this->gameRecordInfo['num'];
    }

    /**
     * @return int
     */
    public function getReason(){
        return $this->gameRecordInfo['reason'];
    }

    /**
     * 获取更改之前的数据
     * @return int
     */
    public function getBefore(){
        return $this->gameRecordInfo['before'];
    }

    /**
     * 获取更给之后的数据
     * @return int
     */
    public function getAfter(){
        return $this->gameRecordInfo['after'];
    }
}