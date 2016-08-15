<?php

/*
 * |--------------------------------------------------------------------------
 * | Application Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register all of the routes for an application.
 * | It's a breeze. Simply tell Laravel the URIs it should respond to
 * | and give it the controller to call when that URI is requested.
 * |
 */
// Route::group(['middleware' => 'auth'], function () {
// Route::get('/', function () {
// // Uses Auth Middleware
// return view ( 'welcome' );
// });

// Route::get('user/profile', function () {
// // Uses Auth Middleware
// });
// });
// var_dump ( csrf_field () );
Route::get('change/locale/{locale}', function ($locale) {
    App::setLocale($locale);

    //
});
Route::get('/', function () {
    // $url = url ( 'posts/{post}/comments/{comment}' );
    // dump ( $url );
    // // dump ( route ( 'profile' ) );
    // $view = view ( 'welcome' );
    return redirect('/home');
});

Route::get('/home', 'Admin\HomeController@home');
Route::get('/dashboard', 'Admin\HomeController@home');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
//Route::get('auth/register', 'Auth\AuthController@getRegister');
//Route::post('auth/register', 'Auth\AuthController@postRegister');

// Route::get ( 'test/testuser/{id?}', 'Test\TestUserController@testA' );
// Route::resource ( 'testA', 'Test\TestA' );
// Route::controller ( 'testB', 'Test\TestB' );
// Route::controller ( 'testBC', 'Test\TestBController', [
// 		'getAaa' => 'user.aaa'
// ] );

Route::get('/user/lookForUserId','Admin\UserController@getLookForUserId');
Route::post('/user/lookForUserId','Admin\UserController@postLookForUserId');


Route::get('user/index', 'Admin\UserController@getIndex');
Route::get('user/userinfo', 'Admin\UserController@getUserInfo');
Route::post('user/userinfo', 'Admin\UserController@postUserInfo');
Route::get('user/diamond', 'Admin\UserController@getAddDiamondAndGameCoin');
Route::post('user/diamond', 'Admin\UserController@postAddDiamondAndGameCoin');

Route::get('user/restaurant', 'Admin\UserController@getRestaurant');
Route::post('user/restaurant', 'Admin\UserController@postRestaurant');

Route::get('user/item', 'Admin\UserController@getItem');
Route::post('user/item', 'Admin\UserController@postItem');

//查询用户充值信息
Route::get('user/recharge', 'Admin\UserController@getSelectRechargeInfo');
Route::post('user/recharge', 'Admin\UserController@postSelectRechargeInfo');


//客户端崩溃日志查询
Route::get('logQuery/crashLogQuery', 'Admin\LogController@getCrashLogInfo');
Route::post('logQuery/crashLogQuery', 'Admin\LogController@postCrashLogInfo');
Route::get('logQuery/crashLogQueryStack/{crash}/{luaVersion}', 'Admin\LogController@getCrashLogGroupInfo');
Route::get('logQuery/gameRecordLogQuery', 'Admin\LogController@getGameRecordLogInfo');
Route::post('logQuery/gameRecordLogQuery', 'Admin\LogController@postGameRecordLogInfo');
Route::get('logQuery/gameRecordLogQueryContext/{game}', 'Admin\LogController@getGameRecordLogInfoGameInfo');


Route::post('logQuery/markResolveOrNot', 'Admin\LogController@markResolveOrNot');
Route::post('logQuery/markCrashWithFlagOrNo', 'Admin\LogController@markCrashWithFlagOrNo');

Route::get('logQuery/gameRecordLogQuery/{gameLogType}', 'Admin\LogController@getGameRecordLogInfoGameLogTypeQuery');


// 邮件部分
Route::get('/gmtools/SystemMail', 'Admin\GMToolsController@getSystemMails');
Route::get('gmtools/delSystemMail/{mailId}', 'Admin\GMToolsController@delSystemMail');
Route::post('gmtools/SendSystemMail', 'Admin\GMToolsController@sendSystemMail');

//服务器状态部分
Route::get('/gmtools/serverStatus', 'Admin\GMToolsController@getServerStatus');
Route::post('/gmtools/changServerStatus', 'Admin\GMToolsController@changeServerStatus');



//查询用户充值信息
Route::get('user/killPlayer', 'Admin\UserController@getKillPlayerInfo');
Route::post('user/killPlayer', 'Admin\UserController@postKillPlayerInfo');

//增加服务器
Route::post('serverStatus/addServer','Admin\ServerStatusController@addServer');

