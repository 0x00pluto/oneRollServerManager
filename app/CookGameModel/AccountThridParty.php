<?php

namespace App\CookGameModel;

use App\Model\GameModel;

class AccountThridParty extends GameModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'accountthirdparty';
    protected $primaryKey = 'link_userid';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function account()
    {
        return $this->hasOne('App\CookGameModel\Account', 'userid');
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     *用户角色信息
     */
    public function role()
    {
        return $this->hasOne('App\CookGameModel\Role', 'userid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * 餐厅信息
     */
    public function restaurant()
    {
        return $this->hasOne('App\CookGameModel\Restaurant', 'userid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * vip信息
     */
    public function vip()
    {
        return $this->hasOne('App\CookGameModel\Vip', 'userid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * 菜谱信息
     */
    public function cookBooks()
    {
        return $this->hasOne('App\CookGameModel\CookBooks', 'userid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * 充值信息
     */
    public function recharge()
    {
        return $this->hasOne('App\CookGameModel\Recharge', 'userid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * 设备信息
     */
    public function device()
    {
        return $this->hasOne('App\CookGameModel\Deviceinfo', 'userid');
    }
}
