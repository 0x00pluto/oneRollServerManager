<?php
/**
 * Created by PhpStorm.
 * User: liuruitao
 * Date: 2015/10/27
 * Time: 11:11
 */

namespace App\CookGameModel;


/**
 * 充值信息解析器
 * Class rechargeData
 * @package App\CookGameModel
 */
class rechargeData
{
    private $orderid = '';
    private $goodsid = '';
    private $isComplete = false;
    private $createTime = 0;
    private $awardDiamonds = 0;

    public function __construct($data)
    {
        $this->orderid = $data['orderid'];
        $this->goodsid = $data['goodsid'];
        $this->isComplete = $data['iscomplete'];
        $this->createTime = $data['createtime'];
        $this->awardDiamonds = $data['awarddiamonds'];
    }

    public function getOrderId()
    {

        return $this->orderid;

    }

    public function getGoodId()
    {

        return $this->goodsid;

    }

    public function getIsComplete()
    {

        return $this->isComplete;

    }

    public function getCreateTime()
    {
        
        return date("Y-m-d H:i:s", $this->createTime);

    }

    public function getAwardDiamonds()
    {

        return $this->awardDiamonds;

    }

}