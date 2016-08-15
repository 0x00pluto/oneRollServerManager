<?php

namespace App\Model;

class GameModel extends \Jenssegers\Mongodb\Model
{
    protected $connection = 'mongodb_game';

    //不显示的公共的信息。
    protected function  getPublicExceptArray()
    {
        $publicArr = [
            '_id',
            'create_at',
            'update_at',
            'userid',
            'dataTemplateType'
        ];
        return $publicArr;
    }

    //显示所有数据信息
    public function toViewData()
    {
        if ($this->exists) {
            return array_except($this->getAttributes(), $this->getPublicExceptArray());
        }
        return [];
    }

}