<?php

namespace App\CookGameModel;

use App\Model\GameModel;

class Role extends GameModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'role';

    protected $primaryKey = 'userid';

    /**
     * 获取年龄
     *
     * @param unknown $birthday
     *            '1985-02-01';
     * @return number
     */
    public static function getage($birthday)
    {
        $age = date('Y', time()) - date('Y', strtotime($birthday)) - 1;
        if (date('m', time()) == date('m', strtotime($birthday))) {

            if (date('d', time()) > date('d', strtotime($birthday))) {
                $age++;
            }
        } elseif (date('m', time()) > date('m', strtotime($birthday))) {
            $age++;
        }
        return $age;
    }

    public function getAgeAttribute($value)
    {
        return Role::getage($this->birthday);
    }

    public function getCreateTimeAttribute($value)
    {
        return date('Y-m-d H:i:s', $value);
    }

    public function getLastestlogintimeAttribute($value)
    {
        return date('Y-m-d H:i:s', $value);
    }

    /**
     * 获取账户数据
     * @return Account
     */
    public function account()
    {
        return $this->hasOne('App\CookGameModel\Account', 'userid')->getResults();
    }

    /**
     * @return Restaurant
     */
    public function restaurant()
    {
        return $this->hasOne('App\CookGameModel\Restaurant', 'userid')->getResults();
    }

    public function toViewData()
    {
        if (!$this->exists) {
            return [];
        }
        $arr = $this->attributes;
        $arr = array_except($arr, $this->getPublicExceptArray());
        $arr = array_except($arr, [
            '_id',
            'vit',
            'vitupdatetime',
            'addgamecoins',
            'camp',
            'frist_recharge',
            'gmlevel',
            'job',
            'pos_x',
            'pos_y',
            'Lat',
            'Lng',
            'level',
            'lastmap',
            'userid',
            'viplevel'
        ]);

        // $arr ['create_time'] = date ( 'Y-n-d H:i:s', $arr ['create_time'] );
        // $arr ['lastest_logintime'] = date ( 'Y-n-d H:i:s', $arr ['lastest_logintime'] );
        // $arr ['age'] = Role::getage ( $role ['birthday'] );
        // $arr ['age'] = $this->getAttribute ( 'age' );
        foreach ($arr as $key => $value) {
            $arr [$key] = $this->getAttribute($key);
        }
        return $arr;
    }
}
