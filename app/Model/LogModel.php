<?php

namespace App\Model;

class LogModel extends \Jenssegers\Mongodb\Model
{
    protected $connection = 'mongodb_log';

    //显示所有数据信息
    public function toViewData()
    {
        if ($this->exists) {
            return $this->getAttributes();
        }
        return [];
    }

}