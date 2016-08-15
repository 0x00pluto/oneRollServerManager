<?php
/**
 * Created by PhpStorm.
 * User: liuruitao
 * Date: 2015/11/18
 * Time: 16:32
 */

namespace App\CookGameLogModel\gameRecordLogModelView;


class gameRecordLogInfoGameInfo_loginOrLogout extends gameRecordLogInfoGameInfo
{
    
    /**
     * 获取用户id
     * @return string
     */
    public function  getUserId(){
        return $this->gameRecordInfo['userid'];
    }

    /**
     * 获取名称
     * @return string
     */
    public function getRoleName(){
        return $this->gameRecordInfo['rolename'];
    }

    /**
     * 获取职业
     * @return int
     */
    public function getJob(){
        return $this->gameRecordInfo['job'];
    }

    /**
     * 获取性别
     * @return int
     */
    public function getSex(){
        return $this->gameRecordInfo['sex'];
    }

    /**
     * 获取游戏金钱
     * @return int
     */
    public function getGameCoin(){
        return $this->gameRecordInfo['gamecoin'];
    }

    /**
     * 获取钻石数
     * @return int
     */
    public function getDiamond(){
        return $this->gameRecordInfo['diamond'];
    }

    /**
     * 获取游戏等级
     * @return int
     */
    public function getGmLevel(){
        return $this->gameRecordInfo['gmlevel'];
    }

    /**
     * 获取创建时间
     * @return int
     */
    public function getCreate_Time(){
        return $this->gameRecordInfo['create_time'];
    }

    /**
     * 获取最后一次登入时间
     * @return int
     */
    public function getLastest_LoginTime(){
        return $this->gameRecordInfo['lastest_logintime'];
    }

    /**
     * 获取最后地图
     * @return int
     */
    public function getLastMap(){
        return $this->gameRecordInfo['lastmap'];
    }

    /**
     * 获取x轴位置
     * @return int
     */
    public function getPos_x(){
        return $this->gameRecordInfo['pos_x'];
    }

    /**
     * 获取y轴位置
     * @return int
     */
    public function getPos_y(){
        return $this->gameRecordInfo['pos_y'];
    }

    /**
     * 获取体力
     * @return int
     */
    public function getVit(){
        return $this->gameRecordInfo['vit'];
    }

    /**
     * 体力更新时间
     * @return int
     */
    public function getVitUpdateTime(){
        return $this->gameRecordInfo['vitupdatetime'];
    }

    /**
     * 获取营地
     * @return int
     */
    public function getCamp(){
        return $this->gameRecordInfo['camp'];
    }

    /**
     * 获取是否第一次充值
     * @return boolean
     */
    public function getFirst_Recharge(){
        return $this->gameRecordInfo['frist_recharge'];
    }
    /**
     * 获取继续登录次数
     * @return int
     */
    public function getContinueLogin(){
        return $this->gameRecordInfo['continuelogin'];
    }

    /**
     * 获取天燃气
     * @return double
     */
    public function getLng(){
        return $this->gameRecordInfo['Lng'];
    }

    /**
     * 获取lat
     * @return double
     */
    public function getLat(){
        return $this->gameRecordInfo['Lat'];
    }

    /**
     * 获取地址
     * @return string
     */
    public function getAddress(){
        return $this->gameRecordInfo['address'];
    }

    /**
     * 获取生日
     * @return string
     */
    public function getBirthday(){
        return $this->gameRecordInfo['birthday'];
    }

    /**
     * 获取sign
     * @return string
     */
    public function getSign(){
        return $this->gameRecordInfo['sign'];
    }

    /**
     * 获取头像icon地址
     * @return string
     */
    public function getHeadIconUrl(){
        return $this->gameRecordInfo['headiconurl'];
    }

    /**
     * 获取增加的游戏金币
     * @return int
     */
    public function getAddGameCoins(){
        return $this->gameRecordInfo['addgamecoins'];
    }

    /**
     * 获取地域id
     * @return int
     */
    public function getZoneId(){
        return $this->gameRecordInfo['zoneid'];
    }

    /**
     * 获取创建时间
     * @return int
     */
    public function getCreate_at(){
        return $this->gameRecordInfo['create_at'];
    }

    /**
     * 获取更新时间
     * @return int
     */
    public function getUpdate_at(){
        return $this->gameRecordInfo['update_at'];
    }

}