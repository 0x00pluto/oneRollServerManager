<?php
/**
 * Created by PhpStorm.
 * User: liuruitao
 * Date: 2015/10/21
 * Time: 11:34
 * 充值信息模块
 */

namespace App\CookGameModel;

use App\Model\GameModel;

class Recharge extends GameModel
{
    protected $table = 'recharge';

    public function toViewData(){
        if(!$this->exists){
            return [];
        }
        $arr = $this->attributes;

        $rechargeInfo = new rechargeInfo($arr);

        return $rechargeInfo;
    }

}




