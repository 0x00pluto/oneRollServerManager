<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/11/14
 * Time: 下午3:15
 */

namespace App\CookGameLogModel;
use App\Model\LogModel;

/**
 * 游戏记录数据
 * Class gameRecordLogModel
 * @package App\CookGameLogModel
 */
class gameRecordLogModel extends logModel
{
    protected $table = 'gameRecordLog';

    /**
     * 游戏记录类型
     * @var array
     */
    static $gameLogType = [
        'LOGTYPE_USERLOGIN',
        'LOGTYPE_USERLOGOUT',
        'LOGTYPE_ADDDIAMOND',
        'LOGTYPE_COSTDIAMOND',
        'LOGTYPE_ADDGAMECOIN',
        'LOGTYPE_COSTGAMECOIN',
        'LOGTYPE_DIAMONDBUYITEM',
        'LOGTYPE_RECHAGRE',
        'LOGTYPE_USERGUIDE_BEGIN',
        'LOGTYPE_USERGUIDE_END',
    ];

    static function getGameRecordLogInfoList($query_type,$query_userId){
        $accountQuery = null;
        if(!empty($query_type) && !empty($query_userId)){
            $query_typeAndUserId = $query_type . ' ' . $query_userId;
            $accountQuery = gameRecordLogModel::where('message','=', $query_typeAndUserId);
        }elseif(empty($query_type)){
            $accountQuery = gameRecordLogModel::where('message','like','%' . $query_userId);
        }else{
            $accountQuery = gameRecordLogModel::where('message','like',$query_type . '%');
        }
        $accountList = $accountQuery->orderBy('datetime','desc');
        return $accountList;
    }

}