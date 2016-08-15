<?php
/**
 * Created by PhpStorm.
 * User: liuruitao
 * Date: 2015/10/16
 * Time: 19:49
 */

namespace App\CookGameModel;


use App\Model\GameModel;

class CookBooks extends GameModel
{
    protected $table = 'cookbooks';

    public function toViewData(){
        if (!$this->exists) {
            return [];
        }

        $arr = $this->attributes;

        /*foreach ($arr['books'] as $key=>$value) {

            $arr[$key] = $this->getAttribute($key);

        }*/

        return $arr['books'];

    }
}