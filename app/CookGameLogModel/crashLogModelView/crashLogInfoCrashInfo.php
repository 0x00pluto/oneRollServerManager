<?php
/**
 * Created by PhpStorm.
 * User: liuruitao
 * Date: 2015/11/4
 * Time: 19:35
 */

namespace App\CookGameLogModel\crashLogModelView;

/**
 * Class crashLogInfoCrashInfo
 * @package App\CookGameLogModel\crashLogModelView
 */
class crashLogInfoCrashInfo
{
    /**
     * @var array
     */
    private $crashInfo;
    /**
     * 设备信息对象
     * @var crashLogInfoDeviceInfo
     */
    private $deviceInfo;

    /**
     * @param array $context
     */
    public function  __construct(array $context)
    {

        $this->crashInfo = $context;

        if(isset($context['deviceinfo'])) {
            $device = $context['deviceinfo'];
        }
        else{
            $device = [
                "SystemVersion"=>"unknown",
                "DeviceName"=>"unknown",
                "DeviceGPUMem"=>"unknown",
                "DeviceId"=>"unknown",
                "DeviceType"=>"unknown",
                "DeviceCPU"=>"unknown",
                "DeviceMem"=>"unknown"
            ];
        }
        $this->deviceInfo = new crashLogInfoDeviceInfo($device);
    }

    /**
     * 获取到lua版本
     * @return string
     */
    public function getLuaVersion()
    {

        return $this->crashInfo['luaversion'];

    }

    /**
     * 获取cpp版本
     * @return string
     */
    public function getCppVersion()
    {
        return $this->crashInfo['cppversion'];
    }

    /**
     * 获取时间
     * @return string
     */
    public function getTime()
    {

        return $this->crashInfo['time'];

    }

    /**
     * 获取编程语言
     * @return string
     */
    public function getCode()
    {

        return $this->crashInfo['code'];

    }

    /**
     * 获取堆信息
     * @return string
     */
    public function getStack()
    {
//        $stack = explode("\n",$this->crashInfo['stack']);
//        return $this->crashInfo['stack'];

//        if (isset($this->crashInfo['stackDetails'])) {
//            return json_encode($this->crashInfo['stackDetails']);
//        } else {
        return $this->crashInfo['stack'];
//        }
    }

    /**
     * 获取客户端版本号
     * @return string
     */
    public function getClientVersion()
    {
        return $this->crashInfo['clientversion'];
    }

    /**
     * 获取设备信息
     * @return crashLogInfoDeviceInfo
     */
    public function getDeviceinfo()
    {
        return $this->deviceInfo;
    }

    /**
     * 获取崩溃信息名称
     * @return string
     */
    public function getCrashName()
    {
        $crashName = '';
        if (isset($this->crashInfo['crashname'])) {
            $crashName = $this->crashInfo['crashname'];
        }
        return $crashName;
    }
}