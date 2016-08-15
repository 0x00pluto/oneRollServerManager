<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/11/23
 * Time: 下午4:32
 */

namespace App\CookAdmin;

/**
 * Class ClientCrashOptions
 * @package App\CookAdmin
 */
class ClientCrashOptions extends Model
{
    protected $table = 'clientCrashResolve';

    protected $primaryKey = "crashId";


    /**
     * @return boolean
     */
    public function isResolve()
    {
        return $this->getAttributeValue('resolve');
    }

    /**
     * @param boolean $resolve
     */
    public function setResolve($resolve)
    {
        $this->setAttribute('resolve', $resolve);
    }


    /**
     * @return boolean
     */
    public function isMarkFlag()
    {
        return $this->markFlag;
    }

    /**
     * @param boolean $markFlag
     */
    public function setMarkFlag($markFlag)
    {
        $this->markFlag = $markFlag;
    }


    /**
     * @param $crashId
     * @return ClientCrashOptions
     */
    public static function createOptions($crashId)
    {
        /**
         * @var ClientCrashOptions $ins
         */
        $ins = self::findOrNew($crashId);
        if (!$ins->exists) {
            $ins->crashId = $crashId;
        }
        return $ins;
    }

}