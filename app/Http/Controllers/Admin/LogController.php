<?php
/**
 * Created by PhpStorm.
 * User: liuruitao
 * Date: 2015/11/4
 * Time: 15:30
 */

namespace App\Http\Controllers\Admin;

use App\CookAdmin\ClientCrashOptions;
use App\CookGameLogModel\crashLogModel;
use App\CookGameLogModel\crashLogModelView\crashLogInfo;
use App\CookGameLogModel\crashLogModelView\crashLogInfoGroup;
use App\CookGameLogModel\crashLogModelView\crashLogInfoGroupDetail;
use App\CookGameLogModel\gameRecordLogModel;
use App\CookGameLogModel\gameRecordLogModelView\gameRecordLogInfo;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class LogController
 * @package App\Http\Controllers\Admin
 */
class LogController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    protected $logPath = 'logQuery/crashLogQuery';

    /**
     * 崩溃信息序号
     */
    const  number = 1;

    /**
     * @param Request $request
     * @return View
     */
    public function getIndex(Request $request)
    {
        return view('log.index');
    }

    /**
     * 显示崩溃信息页面
     * @return string
     */
    public function getCrashLogInfoView()
    {
        return 'log.crashLogInfo';
    }

    public function getGameRecordLogInfoView()
    {
        return 'log.gameRecordLogInfo';
    }

    /**
     * 获取所有的崩溃日志信息
     * @return View
     */
    public function getAllCrashLogInfo()
    {
        /**
         * 获取lua版本
         */
        $luaVersionArr = crashLogModel::getLuaVersionArr();
        $luaVersionArrChart = array_reverse($luaVersionArr);
        $CrashLineChartInfos = [];
        foreach ($luaVersionArrChart as $luaVersion) {
            $CrashLineChartInfos[$luaVersion] = crashLogModel::where('context.luaversion', '=', $luaVersion)->count();
        }


        return view($this->getCrashLogInfoView(), [
            'luaVersionArr' => $luaVersionArr,
//            'crashLogInfoGroup' => $crashLogInfoGroup,
            'number' => 1,
            'CrashLineChartInfos' => $CrashLineChartInfos
        ]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getCrashLogInfo()
    {
        return $this->getAllCrashLogInfo();

    }


    /**
     * 查询 post 崩溃日志信息
     * @param Request $request
     * @return View
     */
    public function postCrashLogInfo(Request $request)
    {
        /**
         * 验证输入是否符合格式
         */
        $this->validate($request, [
            'query_time' => 'date',
            'query_luaVersion' => 'string',
            'page' => 'required|integer'
        ]);


        /**
         * 获取输入的时间
         */
        $query_time = $request->input('query_time');
        $query_luaVersion = $request->input('query_luaVersion');
        // $query_page = $request->input('page');
        /**
         * 根据时间或者lua版本号查询
         */
        /*$pageDataList = crashLogModel::getCrashLogInfoList($query_time, $query_luaVersion);
        $pageDataList = $pageDataList->paginate(crashLogModel::pageSize, ['*'], 'page', $query_page);*/
        /**
         * 获取lua版本
         */
        $luaVersionArr = crashLogModel::getLuaVersionArr();
        $request->flash();

        if (empty($query_luaVersion)) {
            return $this->getAllCrashLogInfo();
        }

        /**
         * 根据时间或者lua版本号查询
         */
        $pageDataGroupList = CrashLogModel::getCrashLogInfoList($query_time, $query_luaVersion);
        $pageDataGroupList = $pageDataGroupList->get();
        $crashLogAllInfo = [];
        foreach ($pageDataGroupList as $pageData) {
            if (!is_null($pageData)) {
                $crashLogAllInfo[] = new crashLogInfo($pageData);
            }
        }

        $crashLogInfoGroup = new crashLogInfoGroup();
        $crashLogInfoGroup->fromArray($crashLogAllInfo);

        foreach ($crashLogInfoGroup->getCrashLogGroupDetails() as $detail) {
            if ($detail instanceof crashLogInfoGroupDetail) {
//                dump($detail->getCrashKey());

                $ClientCrashResolve = ClientCrashOptions::findOrNew($detail->getCrashKey());

                if ($ClientCrashResolve instanceof ClientCrashOptions) {
//                    dump($ClientCrashOptions->exists);
//                    $ClientCrashOptions['crashId'] = $detail->getCrashKey();
//                    $ClientCrashOptions->save();
                }
                break;
            }
        }


        return view($this->getCrashLogInfoView(), [
            'luaVersionArr' => $luaVersionArr,
            'crashLogInfoGroup' => $crashLogInfoGroup,
            'number' => self::number,
        ]);
    }


    /**
     * @param Request $request
     * @return string
     */
    function markResolveOrNot(Request $request)
    {
//        $this->validate($request, [
//            'crashId' => 'required|string',
//            'Resolve' => 'required|boolean'
//        ]);
        $options = ClientCrashOptions::createOptions($request->input('crashId'));
        $isResolve = boolval($request->input("Resolve"));
        $options->setResolve($isResolve);
        $options->save();


        return new JsonResponse($options->getAttributes());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    function markCrashWithFlagOrNo(Request $request)
    {
        $this->validate($request, [
            'crashId' => 'required|string',
            'markFlag' => 'required|boolean'
        ]);
        $options = ClientCrashOptions::createOptions($request->input('crashId'));
        $isMarkFlag = boolval($request->input("markFlag"));
        $options->setMarkFlag($isMarkFlag);
        $options->save();


        return new JsonResponse($options->getAttributes());
    }
    /**
     * 获取单个崩溃日志
     * @param $crashID
     * @return View
     */
    /*function getCrashLogStackInfo($crashID)
    {
        $crashLogModel = crashLogModel::find($crashID);
        $crashLogInfo = null;
        if (!is_null($crashLogModel)) {
            $crashLogInfo = new crashLogInfo($crashLogModel);
        }
        return view('log.crashLogStackInfo', ['crashLogInfo' => $crashLogInfo]);
    }*/

    /**
     * 获取组崩溃信息
     * @param $crashGroupId
     * @return View
     */
    public function getCrashLogGroupInfo($crashGroupId, $luaVersion)
    {
        $pageDataGroupList = crashLogModel::where('context.luaversion', '=', $luaVersion)
            ->orderBy('context.time', 'desc')->get();

//        dump($luaVersion);
        $crashLogAllInfo = [];
        foreach ($pageDataGroupList as $pageData) {
            if (!is_null($pageData)) {
                $crashLogAllInfo[] = new crashLogInfo($pageData);
            }
        }
        $crashLogInfoGroup = new crashLogInfoGroup();
        $crashLogInfoGroup->fromArray($crashLogAllInfo);
        $crashLogInfoGroup = $crashLogInfoGroup->getCrashLogGroupDetail($crashGroupId);


        return view('log.crashLogStackInfo', [
            'crashLogInfoGroup' => $crashLogInfoGroup,
            'number' => self::number,
        ]);
    }


    /**
     * 获取所有游戏日志
     * @return View
     */
    public function getGameRecordLogInfo()
    {
        //取出数据
        $gameRecordAllLogData = gameRecordLogModel::orderBy('datetime', 'desc')->paginate(20);
        $gameRecordAllInfo = [];
        foreach ($gameRecordAllLogData as $gameRecordLogData) {
            if (!is_null($gameRecordLogData)) {
                $gameRecordAllInfo[] = new gameRecordLogInfo($gameRecordLogData);
            }
        }

        return view($this->getGameRecordLogInfoView(), [
            'gameRecordAllInfo' => $gameRecordAllInfo,
            'pages' => $gameRecordAllLogData
        ]);
    }

    /**
     * 查询游戏日志
     * @param Request $request
     * @return View
     */
    public function postGameRecordLogInfo(Request $request)
    {
        /**
         * 验证输入是否合法
         */
        $this->validate($request, [
            'query_type' => 'string',
            'query_userId' => 'string'
        ]);
        $query_type = $request->input('query_type');
        $query_userId = $request->input('query_userId');
        $request->flash();
        $gameRecordLogDatas = gameRecordLogModel::getGameRecordLogInfoList($query_type, $query_userId)->paginate(20);
        $gameRecordLogInfos = [];
        foreach ($gameRecordLogDatas as $gameRecordLogData) {
            if (!is_null($gameRecordLogData)) {
                $gameRecordLogInfos[] = new gameRecordLogInfo($gameRecordLogData);
            }
        }

        return view($this->getGameRecordLogInfoView(), [
            'gameRecordAllInfo' => $gameRecordLogInfos,
            'query_type' => $query_type,
            'pages' => $gameRecordLogDatas
        ]);
    }

    /**
     * 获取单条信息
     * @param $gameId
     * @return View
     */
    public function getGameRecordLogInfoGameInfo($gameId)
    {

        $gameLogInfoData = gameRecordLogModel::find($gameId);
        $gameLogInfo = null;
        if (!is_null($gameLogInfoData)) {
            $gameLogInfo = new gameRecordLogInfo($gameLogInfoData);
        }
//        dump($gameLogInfo);
        return view('log.gameRecordLogInfoGameInfo', ['gameLogInfo' => $gameLogInfo]);
    }

    /**
     * 根据三级菜单来查询记录
     * @param $gameLogType
     * @return View
     */
    public function getGameRecordLogInfoGameLogTypeQuery($gameLogType)
    {
//        dump($gameLogType);
        $gameModelLogType = gameRecordLogModel::$gameLogType;
        $gameRecordAllInfo = [];
        $query_type = null;
        $pages = null;

        if (in_array($gameLogType, $gameModelLogType)) {

            $query_type = $gameLogType;
            $gameRecordLogDatas = gameRecordLogModel::getGameRecordLogInfoList($query_type, '')->paginate(20);
            $pages = $gameRecordLogDatas;
            foreach ($gameRecordLogDatas as $gameRecordLogData) {
                if (!is_null($gameRecordLogData)) {
                    $gameRecordAllInfo[] = new gameRecordLogInfo($gameRecordLogData);
                }
            }
        }

        return view($this->getGameRecordLogInfoView(), [
            'gameRecordAllInfo' => $gameRecordAllInfo,
            'query_type' => $query_type,
            'pages' => $pages
        ]);
    }

}