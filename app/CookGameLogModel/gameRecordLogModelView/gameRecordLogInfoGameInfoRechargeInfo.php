<?php
/**
 * Created by PhpStorm.
 * User: liuruitao
 * Date: 2015/11/17
 * Time: 19:40
 */

namespace App\CookGameLogModel\gameRecordLogModelView;


class gameRecordLogInfoGameInfoRechargeInfo
{
    /**
     * 充值信息
     * @var array
     */
    private $rechargeInfo;
    /**
     * 订单信息
     * @var array
     */
    private $orderData;

    /**
     * 充值信息
     * @var array
     */
    private $rechargeData;

    public function __construct($recharge){
        $this->rechargeInfo = $recharge;
        $this->orderData = $recharge['orderdata'];
        $this->rechargeData = $recharge['rechargedata'];
    }

    /**
     * 订单号
     * @return string
     */
    public function getOrderId(){
        return $this->orderData['orderid'];
    }


    /**
     * 货物号
     * @return string
     */
    public function getGoodsId(){
        return $this->orderData['goodsid'];
    }

    /**
     * 订单是否完成
     * @return boolean
     */
    public function getIsComplete(){
        return $this->orderData['iscomplete'];
    }

    /**
     * 交易时间
     * @return int
     */
    public function getCreateTime(){
        return $this->orderData['createtime'];
    }

    /**
     * 收获的钻石
     * @return int
     */
    public function getAwardDiamonds(){
        return $this->orderData['awarddiamonds'];
    }

    /**
     * 充值金额
     * @return int
     */
    public function getRmb(){
        return $this->rechargeData['rmb'];
    }

    /**
     * 充值钻石数量
     * @return int
     */
    public function  getDiamond(){
        return $this->rechargeData['diamond'];
    }

    /**
     * 获取的经验
     * @return int
     */
    public function getExp(){
        return $this->rechargeData['exp'];
    }
}