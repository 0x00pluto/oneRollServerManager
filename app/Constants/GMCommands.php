<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/11/23
 * Time: 下午3:19
 */

namespace App\Constants;


/**
 * GM 命令常量
 * Class GMCommands
 * @package App\Constants
 */
class GMCommands
{
    /**
     * 获取系统全局邮件
     */
    const GetSystemMailList = 'gmtools.getSystemEmails';

    /**
     * 获取系统全局邮件
     */
    const DelSystemMailList = 'gmtools.removeSystemEmail';

    /**
     * 发送系统邮件
     */
    const SendSystemMail = 'gmtools.sendSystemEmail';

    /**
     * 获取服务器状态
     */
    const GetServerStatus = 'gmtools.getServerState';

    /**
     * 开启服务器
     */
    const ServerOpen = 'gmtools.serverOpen';

    /**
     * 关闭服务器
     */
    const ServerClose = 'gmtools.serverClose';

    /**
     * 增加道具
     */
    const AddItem = 'gmtools.addItem';

    /**
     * 删除用户
     */
    const KillPlayer = 'gmtools.killPlayer';

    /**
     * 充值
     */
    const recharge = 'gmtools.recharge';

    /**
     * 服务器详情
     */
    const ServerDetails = 'gmtools.getServerDetails';
}