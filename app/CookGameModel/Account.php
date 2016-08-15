<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/3/11
 * Time: 上午11:12
 */

namespace app\CookGameModel;


use App\Model\GameModel;

class Account extends GameModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'account';

    protected $primaryKey = 'userid';

    public function toViewData()
    {
        return array_except(parent::toViewData(),
            [
                'username',
                'password',
                'ctl_code'
            ]);

    }


}