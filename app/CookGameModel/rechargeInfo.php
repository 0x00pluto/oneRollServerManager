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
 * Class rechargeInfo
 * @package App\CookGameModel
 */
class rechargeInfo{
    private $userid = '';
    private $unCompleteOrderList = [];
    private $completeOrderList = [];
    private $totalMoney = 0;

    public function __construct($data){
        $this->userid = $data['userid'];
        $this->totalMoney = $data['totalrechargemoney'];
        $completeOrderList = $data['completeorderlist'];
        foreach($completeOrderList as $completeOrder){
            $this->completeOrderList[] = new rechargeData($completeOrder);
        }
        $unCompleteOrderList = $data['uncompleteorderlist'];
        foreach($unCompleteOrderList as $unCompleteOrder){
            $this->unCompleteOrderList[] = new rechargeData($unCompleteOrder);
        }
    }
    public function getUserid(){

        return $this->userid;

    }

    public function getTotalmoney()
    {
        return $this->totalMoney;
    }

    public function getUnCompleteOrderList(){

        return $this->unCompleteOrderList;
    }

    public function getCompleteOrderList(){

        return $this->completeOrderList;
    }

}