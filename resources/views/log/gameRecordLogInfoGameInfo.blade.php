@extends('log.index')
@section('body-content')
<div>
    @if(isset($gameLogInfo))
        <div>
            <h2>游戏日志</h2>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        @if(!empty($messageType = explode(' ',$gameLogInfo->getMessage())))
                            {{ trans('gameRecordLogInfo.' . "$messageType[0]") }}-详细信息
                        @endif
                    </h3>
                </div>
                <div class="panel-body">
                    {{--给子视图传递参数--}}
                    @if($gameLogInfoDetail = ['gameLogInfoDetail' => $gameLogInfo])
                        @endif
                    <p class="navbar-text">
                        {{--用户登录，登出显示--}}
                        @if(strpos($gameLogInfo->getMessage(),'LOGTYPE_USERLOGIN') !== false
                            || strpos($gameLogInfo->getMessage(),'LOGTYPE_USERLOGOUT') !== false
                        )

                            @include('log.gameRecordLogInfoGameInfo.gameRecordLogInfoGameInfo_loginOrLogout',
                                $gameLogInfoDetail)

                        {{--显示增加钻石，花费钻石--}}
                        @elseif(strpos($gameLogInfo->getMessage(),'LOGTYPE_ADDDIAMOND') !== false
                            ||  strpos($gameLogInfo->getMessage(),'LOGTYPE_COSTDIAMOND') !== false
                        )

                            @include('log.gameRecordLogInfoGameInfo.gameRecordLogInfoGameInfo_diamondOrCoin',
                                $gameLogInfoDetail)


                            {{--显示增加金币，花费金币--}}
                        @elseif(strpos($gameLogInfo->getMessage(),'LOGTYPE_ADDGAMECOIN') !== false
                            ||  strpos($gameLogInfo->getMessage(),'LOGTYPE_COSTGAMECOIN') !== false
                        )

                            @include('log.gameRecordLogInfoGameInfo.gameRecordLogInfoGameInfo_diamondOrCoin',
                                $gameLogInfoDetail)


                            {{--显示钻石购买道具--}}
                        @elseif(strpos($gameLogInfo->getMessage(),'LOGTYPE_DIAMONDBUYITEM') !== false)

                            @include('log.gameRecordLogInfoGameInfo.gameRecordLogInfoGameInfo_diamondBuyItem',
                                $gameLogInfoDetail)


                            {{--显示充值--}}
                        @elseif(strpos($gameLogInfo->getMessage(),'LOGTYPE_RECHAGRE') !== false)

                            @include('log.gameRecordLogInfoGameInfo.gameRecordLogInfoGameInfo_rechargeInfo',
                                $gameLogInfoDetail)

                            {{--显示开启，结束新手引导--}}
                        @else
                            @include('log.gameRecordLogInfoGameInfo.gameRecordLogInfoGameInfo_guide',
                                $gameLogInfoDetail)
                        @endif
                    </p>
                </div>
            </div>
        </div>
    @else
        <p>无</p>
    @endif
</div>
@endsection