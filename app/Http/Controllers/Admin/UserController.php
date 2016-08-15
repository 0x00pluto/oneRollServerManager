<?php

namespace App\Http\Controllers\Admin;

use App\Constants\GMCommands;
use app\CookGameModel\Account;
use App\CookGameModel\AccountThridParty;
use App\CookGameModel\CookBooks;
use App\CookGameModel\Deviceinfo;
use App\CookGameModel\Recharge;
use App\CookGameModel\Restaurant;
use App\CookGameModel\Role;
use App\CookGameModel\Vip;
use App\Http\Common\CommonUtils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;

class UserController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('auth');
    }

    protected $userpath = 'user/userinfo';

    public function getIndex(Request $request)
    {
        return view('users.index');
    }

    protected function getUserInfoView()
    {
        return 'users.userinfo';
    }

    protected function getAddDiamondAndGameCoinView()
    {
        return 'users.adddiamondandgamecoin';
    }

    protected function getSelectRechargeView()
    {
        return 'users.rechargeInfo';
    }

    protected function getRestaurantView()
    {
        return 'users.restaurant';
    }

    protected function getItemView()
    {
        return 'users.item';
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function getLookForUserId()
    {
        return view("users.lookForUserId");
    }

    /**
     * @param Request $request
     * @return View
     */
    public function postLookForUserId(Request $request)
    {

        //验证输入格式
        $this->validate($request, [
            'username' => 'required|string|max:64|min:2',
        ]);
        $username = $request->input('username');

        $request->flash();
        $accounts = Role::where('rolename', 'like', "%$username%")->get();
        return $this->getLookForUserId()->with([
            'accounts' => $accounts
        ]);
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function getUserInfo()
    {
        return view($this->getUserInfoView());
    }

    /**
     * @param Request $request
     * @return View
     */
    public function postUserInfo(Request $request)
    {

        //验证输入格式
        $this->validate($request, [
            'userid' => 'required|string|max:64|min:3',
        ]);

        //给userid赋初值
        $userid = $request->input('userid');
        //判断是否是rolename
//        $userid = mb_convert_encoding($userid,"gb2312");
//        $userid = iconv("gb2312", "utf-8//IGNORE", $userid);
//        dump($userid);
        $accountList = Role::where('rolename', '=', $userid)->get();
        $request->flash();
        $accountThirdPartyData = null;
        if (count($accountList) != 0) {
            foreach ($accountList as $accountThirdPartyData) {
                $userid = $accountThirdPartyData['userid'];       //获取到userid的值
                $accountThirdPartyData = AccountThridParty::find($userid);
                if ($accountThirdPartyData instanceof AccountThridParty) {
                    break;
                }
            }
        } else {
            $accountThirdPartyData = AccountThridParty::find($userid);
        }

        if (!$accountThirdPartyData instanceof AccountThridParty) {
            return $this->getUserInfo();
        }

        //获取角色信息
        $role = null;
        $roleDB = $accountThirdPartyData->role()->getResults();
        if ($roleDB instanceof Role) {
            $role = $roleDB->toViewData();
        }
        //获取餐厅信息
        $restaurant = null;
        $restaurantDB = $accountThirdPartyData->restaurant()->getResults();
        if ($restaurantDB instanceof Restaurant) {
            $restaurant = $restaurantDB->toViewData();
        }
        //获取vip信息
        $vip = null;
        $vipDB = $accountThirdPartyData->vip()->getResults();
        if ($vipDB instanceof Vip) {
            $vip = $vipDB->toViewData();
            if (empty($vip)) {
                $vip = ['viplevelinfo' => [
                    'vipexp' => '0',
                    'viptotalexp' => '0',
                    'viplevel' => '0',]
                ];
            }
        }
        //获取菜谱信息
        $cookBook = null;
        $cookBookDB = $accountThirdPartyData->cookBooks()->getResults();
        if ($cookBookDB instanceof CookBooks) {
            $cookBook = $cookBookDB->toViewData();
        }
//        dump($cookBook);
        //获取设备信息
        $deviceinfo = null;
        $deviceinfoDB = $accountThirdPartyData->device()->getResults();
        if ($deviceinfoDB instanceof Deviceinfo) {
            $deviceinfo = $deviceinfoDB->toViewData();
        }

        $accountInfo = null;
        $accountInfoDB = $accountThirdPartyData->account()->getResults();
        if ($accountInfoDB instanceof Account) {
            $accountInfo = $accountInfoDB->toViewData();
        }

//        dump(CrashLogModel::all());

        return view($this->getUserInfoView(), [
            'accountThirdPartyInfo' => $accountThirdPartyData,
            'role' => $role,
            'restaurant' => $restaurant,
            'vip' => $vip,
            'account' => $accountInfo,
            'deviceinfo' => $deviceinfo
        ]);
    }

    public function getAddDiamondAndGameCoin()
    {
        return view($this->getAddDiamondAndGameCoinView());
    }

    /**通过请求获取UserID
     * @param Request $request
     * @param string $key userID的key
     * @return array|string
     */
    private function getUserIdByPost(Request $request, $key = 'userid')
    {
        $this->validate($request, [
            $key => 'required|string|max:64|min:3']);
        $userID = $request->input($key);
        $accountList = Role::where('rolename', '=', $userID)->get();
        if (count($accountList) != 0) {
            $account = $accountList[0];
            $userID = $account['userid'];       //获取到userid的值
        }
        return $userID;
    }

    public function postAddDiamondAndGameCoin(Request $request)
    {
        $this->validate($request, [
            'userid' => 'required|string|max:64|min:3',
            'diamond' => 'required|integer|min:0',
            'gamecoin' => 'required|integer|min:0',
            'reducediamond' => 'required|integer|min:0',
            'reducegamecoin' => 'required|integer|min:0'
        ]);

        //给userid赋初值
        $userid = $request->input('userid');
        //判断是否是rolename
        $accountList = Role::where('rolename', '=', $userid)->get();
        if (count($accountList) != 0) {
            $account = $accountList[0];
            $userid = $account['userid'];       //获取到userid的值
        }
        $request->flash();
        $customErrors = [];
        // $accounts = AccountThridParty::where ( 'link_userid', '=', $request->input ( 'userid' ) )->get ();
        $oldAccount = AccountThridParty::find($userid);;

        $oldRole = null;
        if ($oldAccount instanceof AccountThridParty) {
            $oldRole = $oldAccount->role()->getResults()->toViewData();
            $oldRole = array_only($oldRole, [
                'rolename',
                'gamecoin',
                'diamond'
            ]);
        } else {
            $customErrors [] = '没有找到用户';
            return view($this->getAddDiamondAndGameCoinView())->withErrors($customErrors);
        }
        $rpcReturn = CommonUtils::callAPIRpc('gmtools.addDiamondAndGameCoin', [
            'userid' => $userid,
            'diamond' => $request->input('diamond'),
            'gamecoin' => $request->input('gamecoin')
        ]);

        $rpcReturn = CommonUtils::callAPIRpc('gmtools.reduceDiamondAndGameCoin', [
            'userid' => $userid,
            'diamond' => $request->input('reducediamond'),
            'gamecoin' => $request->input('reducegamecoin')
        ]);

//        dump($rpcReturn);
        // dump($oldaccount->role ()->getResults ()->toViewData ());

        $newRole = $oldAccount->role()->getResults()->toViewData();
        $newRole = array_only($newRole, [
            'rolename',
            'gamecoin',
            'diamond'
        ]);

        return view($this->getAddDiamondAndGameCoinView(), [
            'oldrole' => $oldRole,
            'newrole' => $newRole
        ])->withErrors($customErrors);
    }

    //用户充值信息查询

    public function getSelectRechargeInfo()
    {

        return view($this->getSelectRechargeView());

    }

    public function PostSelectRechargeInfo(Request $request)
    {
        //验证输入格式
        $this->validate($request, [
            'userid' => 'required|string|max:64|min:3',
        ]);
        //给userid赋初值
        $userid = $request->input('userid');
        //判断是否是rolename
        $accountList = Role::where('rolename', '=', $userid)->get();
        if (count($accountList) != 0) {
            $account = $accountList[0];
            $userid = $account['userid'];       //获取到userid的值
        }

        $request->flash();
        $account = AccountThridParty::find($userid);

        if (!$account instanceof AccountThridParty) {
            return $this->getSelectRechargeInfo();
        }
        $rechargeInfo = null;
        $rechargeDB = $account->recharge()->getResults();

        if ($rechargeDB instanceof Recharge) {    //从recharge中获取数据
            $rechargeInfo = $rechargeDB->toViewData();
        }
        return view($this->getSelectRechargeView(), [
            'rechargeInfo' => $rechargeInfo,
        ]);

    }


    /**
     * @return View
     */
    public function getItem()
    {
        return view($this->getItemView());
    }

    /**
     * post增加道具信息
     * @param Request $request
     * @return View
     */
    public function postItem(Request $request)
    {
        $userID = $this->getUserIdByPost($request);
        $this->validate($request, [
            'itemId' => 'required|integer|min:0',
            'itemCount' => 'required|integer|min:1',
        ]);
        $request->flash();

        $customErrors = [];

        $itemId = $request->input('itemId');
        $itemCount = $request->input('itemCount');

        $result = CommonUtils::GMAPICall(GMCommands::AddItem, [
            'userId' => $userID,
            'itemId' => $itemId,
            'itemCount' => $itemCount
        ]);
//        $result->is_succ()

//        dump(result);

        return view($this->getItemView(), [
            'result' => $result
        ])->withErrors($customErrors);

    }

    /**
     * @return View
     */
    public function getRestaurant()
    {
        return view($this->getRestaurantView());
    }

    /**
     * post餐厅信息
     * @param Request $request
     * @return View
     */
    public function postRestaurant(Request $request)
    {
        $userID = $this->getUserIdByPost($request);
        $this->validate($request, [
            'exp' => 'required|integer|min:0'
        ]);
        $request->flash();
        $exp = $request->input('exp');

        $customErrors = [];

        $oldAccount = AccountThridParty::find($userID);
        $oldData = [];
        $newData = [];


        do {
            if (!$oldAccount instanceof AccountThridParty) {
                $customErrors[] = "没有找到用户";
                break;
            }

            $restaurantDB = $oldAccount->restaurant()->getResults();
            if (!$restaurantDB instanceof Restaurant) {
                $customErrors[] = "没有餐厅信息";
                break;
            }
            $exceptArray = ['customs', 'customvips'];
            $oldData = $restaurantDB->toViewData();

            $oldData = array_except($oldData, $exceptArray);

            //Command

            $CommandReturn = CommonUtils::callAPIRpc('gmtools.addrestaurantexp',
                [
                    'userid' => $userID,
                    'exp' => $exp
                ]);

//            dump($CommandReturn);


            $restaurantDB = $oldAccount->restaurant()->getResults();
            $newData = $restaurantDB->toViewData();
            $newData = array_except($newData, $exceptArray);


        } while (0);

        return view($this->getRestaurantView(), [
            'oldData' => $oldData,
            'newData' => $newData
        ])->withErrors($customErrors);
    }


    /**
     * @return View
     */
    public function getKillPlayerInfo()
    {
        return view('users.killPlayer');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function postKillPlayerInfo(Request $request)
    {
        $userID = $this->getUserIdByPost($request);

        $request->flash();

        $customErrors = [];


        $result = CommonUtils::GMAPICall(GMCommands::KillPlayer, [
            'userId' => $userID,
        ]);
//        $result->is_succ()

//        dump(result);

        return view('users.killPlayer', [
            'result' => $result
        ])->withErrors($customErrors);
    }
}
