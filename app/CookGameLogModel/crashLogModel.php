<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/11/3
 * Time: 下午5:25
 */

namespace App\CookGameLogModel;


use App\CookGameLogModel\crashLogModelView\crashLogInfo;
use App\Model\LogModel;

class crashLogModel extends LogModel
{


    protected $table = 'crashRecordLog';
    const pageSize = 20;

    /**
     *根据前台输入来查询数据
     * @param $query_time
     * @param $query_luaVersion
     * @return array
     */
    static function getCrashLogInfoList($query_time, $query_luaVersion)
    {
        $accountQuery = null;
        if (!empty($query_luaVersion) && !empty($query_time)) {
            $accountQuery = CrashLogModel::where('datetime', 'like', $query_time . '%')
                ->where('context.luaversion', '=', $query_luaVersion);
        } elseif (!empty($query_luaVersion)) {
            $accountQuery = CrashLogModel::where('context.luaversion', '=', $query_luaVersion);
        } else {
            $accountQuery = CrashLogModel::where('datetime', 'like', $query_time . '%');
        }
        $accountList = $accountQuery->orderBy('context.time', 'desc');
//            ->paginate(self::pageSize);
        return $accountList;
    }

    /**
     * 获取数据库中所有的lua版本号
     * @return array
     */
    static function getLuaVersionArr()
    {
        $luaVersionArr = [];
        $luaVersionList = crashLogModel::distinct('context.luaversion')->get();
        foreach ($luaVersionList as $luaVersion) {
            if (!stripos($luaVersion[0], "_")) {
                $luaVersionArr[] = $luaVersion[0];
            }
        }
        sort($luaVersionArr, SORT_NATURAL);
        $luaVersionArr = array_reverse($luaVersionArr);
        $luaVersionArr = array_slice($luaVersionArr, 0, 5);
        return $luaVersionArr;
    }
}