<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/4/27
 * Time: 上午11:33
 */

namespace App\Http\Controllers\Admin;

use App\CookAdmin\ServerSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServerStatusController extends Controller
{
    /**
     * GMToolsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addServer(Request $request)
    {
        $this->validate($request, [
            'serverName' => 'required|string',
            'serverHostName' => 'required|string',
            'apiUrl' => 'required|string',
        ]);
        
        $serverSetting = ServerSetting::create($request->input());

//        $serverSetting->save();

        return new JsonResponse($serverSetting->getAttributes());
    }
}