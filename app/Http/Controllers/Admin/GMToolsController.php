<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/11/23
 * Time: 下午3:02
 */

namespace App\Http\Controllers\Admin;


use App\Constants\GMCommands;
use App\CookAdmin\ServerSetting;
use App\Http\Common\CommonUtils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GMToolsController extends Controller
{

    /**
     * GMToolsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * 获取全部邮件
     * @return $this
     */
    public function getSystemMails()
    {

        $returnData = CommonUtils::GMAPICall(GMCommands::GetSystemMailList, []);
        $Mails = [];
        if ($returnData->is_succ()) {
            $Mails = $returnData->get_retdata();
        }

        return view('mails.index')->with([
            'mails' => $Mails
        ]);
    }

    /**
     * 删除系统邮件
     * @param $mailId
     * @return GMToolsController
     */
    public function delSystemMail($mailId)
    {
//        dump($mailId);
        CommonUtils::GMAPICall(GMCommands::DelSystemMailList, ['mailid' => $mailId]);

        return redirect("gmtools/SystemMail");
    }


    /**
     * 发送系统邮件
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function sendSystemMail(Request $request)
    {


        //需要字段
        //邮件标题 title
        //邮件内容 content
        $title = $request->input("title");
        $context = $request->input("context");

        $returnData = CommonUtils::GMAPICall(GMCommands::SendSystemMail,
            [
                'title' => $title, 'content' => $context
            ]);
        if ($returnData->is_succ()) {

            //成功操作

        } else {

            //添加失败

        }

        // 渲染页面
        return redirect("gmtools/SystemMail");
    }

    /**
     * 获取服务器状态
     * @return \Illuminate\View\View
     */

    function getServerStatus()
    {
        $returnData = CommonUtils::GMAPICall(GMCommands::GetServerStatus);

        $serverStatus = $returnData->get_retdata();

        $serverDetailsReturnData = CommonUtils::GMAPICall(GMCommands::ServerDetails);
        $serverDetails = $serverDetailsReturnData->get_retdata();


        $serverSettings = ServerSetting::all();

        $serversInformation = [];
        foreach ($serverSettings as $serverSetting) {
            $serverInformation = [];
            $serverApi = "http://" . $serverSetting->serverHostName . "/" . $serverSetting->apiUrl;
            $serverIsOpenReturnData = CommonUtils::GMAPICall(GMCommands::GetServerStatus, [], $serverApi);
            $serverInformation['general'] = $serverSetting;
            $serverInformation['isOpen'] = $serverIsOpenReturnData->is_succ() ? $serverIsOpenReturnData->get_retdata() : false;
            $serverDetailsReturnData = CommonUtils::GMAPICall(GMCommands::ServerDetails, [], $serverApi);
            $serverDetails = $serverDetailsReturnData->is_succ() ? $serverDetailsReturnData->get_retdata() : [];
            $serverInformation['Details'] = $serverDetails;
            $serverInformation['ApiUrl'] = $serverApi;

            $serversInformation[] = $serverInformation;
        }

//        dump($serversInformation);


        return view('serverStatus.index',
            [
                'serverStatus' => $serverStatus,
                'serverDetails' => $serverDetails,
                'serversInformation' => $serversInformation
            ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function changeServerStatus(Request $request)
    {
        $this->validate($request, [
            'serverStatus' => 'required'
        ]);

        $serverStatus = intval($request->input('serverStatus'));
        if ($serverStatus == 0) {
            CommonUtils::GMAPICall(GMCommands::ServerClose);
        } else {
            CommonUtils::GMAPICall(GMCommands::ServerOpen);

        }

        return redirect('/gmtools/serverStatus');
    }


}