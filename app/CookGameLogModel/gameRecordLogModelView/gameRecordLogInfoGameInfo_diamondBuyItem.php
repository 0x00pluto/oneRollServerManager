<?php
/**
 * Created by PhpStorm.
 * User: liuruitao
 * Date: 2015/11/18
 * Time: 16:35
 */

namespace App\CookGameLogModel\gameRecordLogModelView;


class gameRecordLogInfoGameInfo_diamondBuyItem extends gameRecordLogInfoGameInfo
{
    /**
     * 获取钻石数
     * @return int
     */
    public function getDiamonds()
    {
        return $this->gameRecordInfo['diamonds'];
    }

    /**
     * 获取道具id
     * @return int
     */
    public function getItemId()
    {
        return $this->gameRecordInfo['$itemid'];
    }

    /**
     * 获取购买道具数量
     * @return int
     */
    public function getItemCount()
    {
        return $this->gameRecordInfo['$itemcount'];
    }

    public function getShortDescription()
    {
        $description = "";
        $description .= " 道具ID:" . $this->getItemId();
        $description .= " 数据数量:" . $this->getItemCount();
        $description .= " 花费钻石数量:" . $this->getDiamonds();
        return $description;

    }

}