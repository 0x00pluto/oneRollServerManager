<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/11/23
 * Time: 下午3:24
 */

namespace App\Http\Common;


class CommonReturnVar
{
    /**
     * 是否成功
     *
     * @var string
     */
    const DBKey_retsucc = "retsucc";

    /**
     * 返回code
     *
     * @var string
     */
    const DBKey_retcode = "retcode";

    /**
     * 返回数据
     *
     * @var string
     */
    const DBKey_retdata = "retdata";

    /**
     * 返回code str解释
     *
     * @var string
     */
    const DBKey_retcode_str = "retcode_str";

    /**
     *
     * 构建消息返回值
     *
     * @param bool $succ
     *            true or false
     * @param int $code
     *            代码
     * @param any $data
     *            扩展包含数据
     *
     * @return CommonReturnVar
     */
    public static function Ret($succ, $code = 0, $data = null, $code_string = '')
    {
        $succ = boolval($succ);
        $code = intval($code);
        $code_string = strval($code_string);
        $retarr = new self ($succ, $code, $data, $code_string);

        return $retarr;
    }

    /**
     *
     * 构建消息返回值(成功)
     *
     * @param any $data
     *            扩展包含数据
     * @param int $code
     *            代码
     *
     * @return CommonReturnVar
     */
    public static function RetSucc($code = 0, $data = null, $code_string = '')
    {
        return CommonReturnVar::Ret(true, $code, $data, $code_string);
    }

    /**
     *
     * 构建消息返回值(失败)
     *
     * @param any $data
     *            扩展包含数据
     * @param int $code
     *            代码
     *
     * @return CommonReturnVar
     */
    public static function RetFail($code = 0, $data = null, $code_string = '')
    {
        return CommonReturnVar::Ret(false, $code, $data, $code_string);
    }

    /**
     * 返回消息是否成功
     *
     * @param CommonReturnVar $retdata
     *            RetFail RetSucc Ret 返回结果
     */
    public static function isSucc($retdata)
    {
        return $retdata->get_retsucc();
    }

    /**
     * 返回消息是否失败
     *
     * @param CommonReturnVar $retdata
     *            RetFail RetSucc Ret 返回结果
     */
    public static function isFailed($retdata)
    {
        return !self::isSucc($retdata);
    }

    /**
     * 获得返回结果中的数据
     *
     * @param CommonReturnVar $retdata
     */
    public static function getdata($retdata)
    {
        return $retdata->get_retdata();
    }

    /**
     * 获得返回结果中的编码
     *
     * @param CommonReturnVar $retdata
     */
    public static function getcode($retdata)
    {
        return $retdata->get_retcode();
    }

    private $_data = array();

    function __construct($succ, $code = 0, $data = null, $code_string = '')
    {
        $succ = boolval($succ);
        $code = intval($code);
        $code_string = strval($code_string);
        $this->_data [self::DBKey_retsucc] = $succ;
        $this->_data [self::DBKey_retcode] = $code;
        $this->_data [self::DBKey_retdata] = $data;
        $this->_data [self::DBKey_retcode_str] = $code_string;
    }

    /**
     * 获取返回码
     *
     * @return number
     */
    function get_retcode()
    {
        return intval($this->_data [self::DBKey_retcode]);
    }

    /**
     * 是否成功
     *
     * @return boolean
     */
    function is_succ()
    {
        return $this->get_retsucc();
    }

    /**
     * 是否失败
     *
     * @return boolean
     */
    function is_failed()
    {
        return !$this->is_succ();
    }

    /**
     * 获取是否成功
     *
     * @return boolean
     */
    function get_retsucc()
    {
        return boolval($this->_data [self::DBKey_retsucc]);
    }

    /**
     * 设置失败
     */
    function set_failed()
    {
        $this->_data [self::DBKey_retsucc] = FALSE;
    }

    /**
     * 设置成功
     */
    function set_succ()
    {
        $this->_data [self::DBKey_retsucc] = TRUE;
    }

    /**
     * 获取返回数据
     * @return mixed
     */
    function get_retdata()
    {
        return $this->_data [self::DBKey_retdata];
    }

    function set_retdata($data)
    {
        $this->_data [self::DBKey_retdata] = $data;
    }

    /**
     * 获取返回码说明
     *
     * @return string
     */
    function get_retcode_str()
    {
        return strval($this->_data [self::DBKey_retcode_str]);
    }

    /**
     * 获取原始数组数据
     */
    function to_Array()
    {
        return $this->_data;
    }

    /**
     * 通过调用rpc调用返回
     *
     * @param array $message_arr
     * @return CommonReturnVar
     */
    static function create_with_message_arr(array $message_arr)
    {
        $ins = new self (false);
        $ins->_data = $message_arr ["data"];
        return $ins;
    }
}

?>