<?php
namespace App\CookGameModel;

use App\Model\GameModel;


class Vip extends GameModel
{
    protected $table = 'vip';

    public function toViewData()
    {
        if (!$this->exists) {
            return [];
        }

        $arr =$this->attributes;
        /*$arr=array_except($arr,$this->getPublicExceptArray());

        foreach ($arr['viplevelinfo'] as $key=> $value) {

            $arr [$key]= $this->getAttribute($key);

        }*/

        return $arr;

    }


}