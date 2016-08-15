<?php
/**
 * Created by PhpStorm.
 * User: liuruitao
 * Date: 2015/11/2
 * Time: 11:42
 */

namespace App\CookGameModel;

use App\Model\GameModel;

class Deviceinfo extends GameModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'deviceinfo';

    public function toViewData(){
        if(!$this->exists){
            return [];
        }

        $arr = $this->attributes;
        $arr=array_except($arr,$this->getPublicExceptArray());

        return $arr;
    }
}