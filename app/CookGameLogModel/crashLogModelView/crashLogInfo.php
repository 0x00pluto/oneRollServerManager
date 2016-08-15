<?php
/**
 * Created by PhpStorm.
 * User: liuruitao
 * Date: 2015/11/4
 * Time: 19:29
 */

namespace App\CookGameLogModel\crashLogModelView;

use App\CookGameLogModel\crashLogModel;

/**
 * Class crashLogInfo
 * @package App\CookGameLogModel\crashLogModelView
 */
class crashLogInfo
{
    private $message = '';
    /**
     * 崩溃信息对象
     * @var crashLogInfoCrashInfo
     */
    private $crashInfo;

    /**
     * 崩溃日志对象
     * @var CrashLogModel
     */
    private $crashData;


    /**
     * @param CrashLogModel $data
     */
    public function __construct(crashLogModel $data)
    {
        $this->crashData = $data;
        $this->message = $this->crashData['message'];

        $context = $this->crashData['context'];

        $this->crashInfo = new crashLogInfoCrashInfo($context);

    }

    /**
     * 获取崩溃信息message
     * @return string
     */
    public function getMessage(){
        return $this->message;
    }
    /**
     * 判断是否有crashName
     * 有则显示crashName
     * 无则获取崩溃信息message
     * @return string
     */
    public function getCrashMessage()
    {
        if(!empty($this->crashInfo->getCrashName())){
            return $this->crashInfo->getCrashName();
        }else{
            return $this->message;
        }

    }

    /**
     * 获取崩溃的详细信息
     * @return crashLogInfoCrashInfo
     */
    public function getCrashInfo()
    {
        return $this->crashInfo;
    }

    /**
     * 获得崩溃id
     * @return string
     */
    public function getCrashId()
    {
        return $this->crashData->getKey();
    }
}