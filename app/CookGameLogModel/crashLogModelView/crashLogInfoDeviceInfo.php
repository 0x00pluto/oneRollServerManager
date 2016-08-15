<?php
/**
 * Created by PhpStorm.
 * User: liuruitao
 * Date: 2015/11/4
 * Time: 20:02
 */

namespace App\CookGameLogModel\crashLogModelView;

/**
 * Class crashLogInfoDeviceInfo
 * @package App\CookGameLogModel\crashLogModelView
 */
class crashLogInfoDeviceInfo
{
    /**
     *
     * @var array
     */
    private $deviceInfo;

    /**
     * @param array $deviceInfo
     */
    public function __construct(array $deviceInfo){
        $this->deviceInfo = $deviceInfo;
    }

    /**
     * 系统版本号
     * @return string
     */
    public function getSystemVersion(){
        return $this->deviceInfo['SystemVersion'];
    }

    /**
     * 设备名称
     * @return string
     */
    public function getDeviceName(){
        return $this->deviceInfo['DeviceName'];
    }

    
    /**
     * 设备GPUMem
     * @return string
     */
    public function getDeviceGPUMem(){
        return $this->deviceInfo['DeviceGPUMem'];
    }

    /**
     * 设备ID
     * @return string
     */
    public function getDeviceId(){
        return $this->deviceInfo['DeviceId'];
    }

    /**
     * 设备类型
     * @return mixed
     */
    public function getDeviceType(){
        return $this->deviceInfo['DeviceType'];
    }

    /**
     * 设备cpu
     * @return string
     */
    public function getDeviceCPU(){
        return $this->deviceInfo['DeviceCPU'];
    }

    /**
     *设备缓存
     * @return int
     */
    public function getDeviceMem(){

        return $this->deviceInfo['DeviceMem'];
    }
}