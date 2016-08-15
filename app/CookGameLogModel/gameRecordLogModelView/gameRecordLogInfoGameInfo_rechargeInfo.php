<?php
/**
 * Created by PhpStorm.
 * User: liuruitao
 * Date: 2015/11/17
 * Time: 19:40
 */

namespace App\CookGameLogModel\gameRecordLogModelView;


class gameRecordLogInfoGameInfo_rechargeInfo extends gameRecordLogInfoGameInfo
{
    /**
     * 订单信息
     * @var array
     */
    public $orderData;

    /**
     * 充值信息
     * @var array
     */
    private $rechargeData;

    /**
     * 获取订单信息
     * @return array
     */
    public function getOrderData()
    {
        $this->orderData = $this->gameRecordInfo['orderdata'];
        return $this->orderData;
    }

    /**
     * 获取充值信息
     * @return array
     */
    public function getRechargeData()
    {
        $this->rechargeData = $this->gameRecordInfo['rechargedata'];
        return $this->rechargeData;
    }

    public function getShortDescription()
    {
        $description = "";
        $description .= "商品ID:" . $this->getOrderData()['goodsid'] . " ";
        $description .= "充值金额:" . $this->getRechargeData()['rmb'] . "分";
        return $description;
    }


}