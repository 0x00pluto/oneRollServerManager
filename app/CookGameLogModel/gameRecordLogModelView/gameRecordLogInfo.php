<?php

/**
 * Created by PhpStorm.
 * User: liuruitao
 * Date: 2015/11/16
 * Time: 11:25
 */
namespace App\CookGameLogModel\gameRecordLogModelView;

use App\CookGameLogModel\gameRecordLogModel;

/**
 * Class gameRecordLogInfo
 * @package App\CookGameLogModel\gameRecordLogModelView
 */
class gameRecordLogInfo
{
    /**
     * 游戏日志message
     * @var string
     */
    private $message = '';
    /**
     * 游戏日志时间
     * @var string
     */
    private $datetime = '';
    /**
     * 游戏日志详细信息对象
     * @var gameRecordLogInfoGameInfo
     */
    private $gameInfo;
    /**
     * 游戏日志对象
     * @var gameRecordLogModel
     */
    private $gameRecordData;

    /**
     * @param gameRecordLogModel $data
     */
    public function __construct(gameRecordLogModel $data)
    {
        $this->gameRecordData = $data;
        $this->message = $this->gameRecordData['message'];

        $this->datetime = $this->gameRecordData['datetime'];

        $this->context = $this->gameRecordData['context'];

        $this->gameInfo = new gameRecordLogInfoGameInfo($this->context);
    }

    /**
     * 获取游戏记录message
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * 获取游戏记录时间
     * @return string
     */
    public function getDateTime()
    {
        return $this->datetime;
    }

    /**
     * 游戏记录详细信息父类
     * @return gameRecordLogInfoGameInfo
     */
    public function getGameInfo()
    {
        return $this->gameInfo;
    }

    /**
     * 获得游戏日志id
     * @return string
     */
    public function getGameRecordId()
    {
        return $this->gameRecordData->getKey();
    }

    public function getDetailMessage()
    {
        $message = explode(' ', $this->message);
        $messageType = $message[0];

        switch ($messageType) {
            case "LOGTYPE_RECHAGRE":
                $gameInfoDetails = new gameRecordLogInfoGameInfo_rechargeInfo($this->context);
                $detailMessage = $gameInfoDetails->getShortDescription();
                break;

            case "LOGTYPE_DIAMONDBUYITEM":
                $gameInfoDetails = new gameRecordLogInfoGameInfo_diamondBuyItem($this->context);
                $detailMessage = $gameInfoDetails->getShortDescription();

                break;
            default:
                $detailMessage = json_encode($this->context);
        }
        return $detailMessage;
    }

    /**
     * 获取游戏详细信息对象
     * @return gameRecordLogInfoGameInfo_diamondBuyItem
     * |gameRecordLogInfoGameInfo_diamondOrCoin|
     * gameRecordLogInfoGameInfo_guide|
     * gameRecordLogInfoGameInfo_loginOrLogout|
     * gameRecordLogInfoGameInfo_rechargeInfo|null
     */
    public function getGameInfoDetails()
    {

        $gameInfoDetails = null;
        $message = explode(' ', $this->message);
        $messageType = $message[0];
        if ($messageType == 'LOGTYPE_USERLOGIN' || $messageType == 'LOGTYPE_USERLOGOUT') {

            $gameInfoDetails = new gameRecordLogInfoGameInfo_loginOrLogout($this->context);

        } elseif ($messageType == 'LOGTYPE_DIAMONDBUYITEM') {

            $gameInfoDetails = new gameRecordLogInfoGameInfo_diamondBuyItem($this->context);

        } elseif ($messageType == 'LOGTYPE_RECHAGRE') {

            $gameInfoDetails = new gameRecordLogInfoGameInfo_rechargeInfo($this->context);

        } elseif ($messageType == 'LOGTYPE_USERGUIDE_END' || $messageType == 'LOGTYPE_USERGUIDE_BEGIN') {

            $gameInfoDetails = new gameRecordLogInfoGameInfo_guide($this->context);
        } else {

            $gameInfoDetails = new gameRecordLogInfoGameInfo_diamondOrCoin($this->context);
        }
        return $gameInfoDetails;
    }

}