<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/11/12
 * Time: 下午9:24
 */

namespace App\CookGameLogModel\crashLogModelView;


/**
 * Class crashLogInfoGroup
 * @package app\CookGameLogModel\crashLogModelView
 */
class crashLogInfoGroup
{
    private $crashLogInfos;

    /**
     * 详细崩溃信息组
     * @var array
     */
    private $crashLogGroupDetails = [];


    public function __construct()
    {

    }


    /**
     * @param array $crashLogInfos 崩溃信息
     */
    public function fromArray(array $crashLogInfos = [])
    {
        $this->crashLogInfos = $crashLogInfos;

        foreach ($crashLogInfos as $crashLogInfo) {
            if ($crashLogInfo instanceof crashLogInfo) {
                $this->addCrashLogInfo($crashLogInfo);
            }
        }
    }

    /**
     * @param crashLogInfo $crashLogInfo
     */
    private function addCrashLogInfo(crashLogInfo $crashLogInfo)
    {
        $groupKey = crashLogInfoGroupDetail::getCrashKeyword($crashLogInfo);
        $crashLogGroupDetail = null;
        if (isset($this->crashLogGroupDetails[$groupKey])) {
            $crashLogGroupDetail = $this->crashLogGroupDetails[$groupKey];
        } else {
            $crashLogGroupDetail = new crashLogInfoGroupDetail($crashLogInfo);
            $this->crashLogGroupDetails[$groupKey] = $crashLogGroupDetail;
        }
        $crashLogGroupDetail->addCrashLogInfo($crashLogInfo);
    }

    /**
     * @return array
     */
    public function getCrashLogGroupDetails()
    {
        return $this->crashLogGroupDetails;
    }

    /**
     * 获取组崩溃信息
     * @param $crashGroupId
     * @return null|crashLogInfoGroupDetail
     */
    public function getCrashLogGroupDetail($crashGroupId)
    {
        if (isset($this->crashLogGroupDetails[$crashGroupId])) {
            return $this->crashLogGroupDetails[$crashGroupId];
        }
        return null;
    }
}