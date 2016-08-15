<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/11/12
 * Time: 下午9:27
 */

namespace App\CookGameLogModel\crashLogModelView;


class crashLogInfoGroupDetail
{
    private $crashKey;

    /**
     * @return string
     */
    public function getCrashKey()
    {
        return $this->crashKey;
    }


    /**
     * 崩溃信息集合
     * @var array
     */
    private $crashLogInfos = [];

    /**
     * 示例崩溃信息
     * @var crashLogInfo
     */
    private $exampleCrashLogInfo = null;

    /**
     * @param crashLogInfo $crashLogInfo
     */
    public function __construct(crashLogInfo $crashLogInfo)
    {
        $this->crashKey = self::getCrashKeyword($crashLogInfo);
        $this->exampleCrashLogInfo = $crashLogInfo;
    }


    /**
     * @param crashLogInfo $crashLogInfo
     */
    public function addCrashLogInfo(crashLogInfo $crashLogInfo)
    {
        $this->crashLogInfos[$crashLogInfo->getCrashId()] = $crashLogInfo;
    }

    /**
     * 获取所有崩溃信息
     * @return array
     */
    public function getCrashLogInfos()
    {
        return $this->crashLogInfos;
    }

    /**
     * 获取通过消息头合并的崩溃信息
     * @return array
     */
    public function getCrashLogInfoMergeByMessage()
    {
        $crashInfos = [];
        foreach ($this->crashLogInfos as $crashLogInfo) {
            $crashInfos[$crashLogInfo->getMessage()] = $crashLogInfo;
        }
        return $crashInfos;
    }

    /**
     * 获取提示崩溃信息
     * @return crashLogInfo|null
     */
    public function getTipCrashLogInfo()
    {
        return last($this->crashLogInfos);
    }

    /**
     * 获取崩溃的lua版本号
     * @return string
     */
    public function getCrashLuaVersion()
    {
        return $this->exampleCrashLogInfo->getCrashInfo()->getLuaVersion();
    }

    /**
     * 获取崩溃关键字
     * @param crashLogInfo $crashLogInfo
     * @return string
     */
    static public function getCrashKeyword(crashLogInfo $crashLogInfo)
    {
        return md5($crashLogInfo->getCrashInfo()->getLuaVersion() . $crashLogInfo->getCrashInfo()->getStack());
    }

}