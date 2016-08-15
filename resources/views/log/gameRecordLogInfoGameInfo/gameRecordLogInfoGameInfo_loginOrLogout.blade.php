{{--登入，退出信息--}}

{{ trans('gameRecordLogInfoGameInfo.' . 'userId') }}：
{{ $gameLogInfoDetail->getGameInfoDetails()->getUserId() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'roleName') }}：
{{ $gameLogInfoDetail->getGameInfoDetails()->getRoleName() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'job') }}：
{{ $gameLogInfoDetail->getGameInfoDetails()->getJob() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'sex') }}：
{{ $gameLogInfoDetail->getGameInfoDetails()->getSex() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'gameCoin') }}：
{{ $gameLogInfoDetail->getGameInfoDetails()->getGameCoin() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'diamond') }}：
{{ $gameLogInfoDetail->getGameInfoDetails()->getDiamond() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'gmLevel') }}：
{{ $gameLogInfoDetail->getGameInfoDetails()->getGmLevel() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'createTime') }}：
{{ date("Y-m-d H:i:s",$gameLogInfoDetail->getGameInfoDetails()->getCreate_Time()) }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'lastTest_Login') }}：
{{ date("Y-m-d H:i:s",$gameLogInfoDetail->getGameInfoDetails()->getLastest_LoginTime()) }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'lastMap') }}：
{{ $gameLogInfoDetail->getGameInfoDetails()->getLastMap() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'pos_x') }}：
{{ $gameLogInfoDetail->getGameInfoDetails()->getPos_x() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'pox_y') }}：
{{ $gameLogInfoDetail->getGameInfoDetails()->getPos_y() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'vit') }}：
{{ $gameLogInfoDetail->getGameInfoDetails()->getVit() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'vitUpdateTime') }}：
{{ date("Y-m-d H:i:s",$gameLogInfoDetail->getGameInfoDetails()->getVitUpdateTime()) }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'camp') }}：
{{ $gameLogInfoDetail->getGameInfoDetails()->getCamp() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'first_recharge') }}：
{{ $gameLogInfoDetail->getGameInfoDetails()->getFirst_Recharge() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'continueLogin') }}：
{{ $gameLogInfoDetail->getGameInfoDetails()->getContinueLogin() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'lnt') }}：
{{ $gameLogInfoDetail->getGameInfoDetails()->getLng() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'lat') }}:
{{ $gameLogInfoDetail->getGameInfoDetails()->getLat() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'address') }}：
{{ $gameLogInfoDetail->getGameInfoDetails()->getAddress() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'birthday') }}：
{{ $gameLogInfoDetail->getGameInfoDetails()->getBirthday() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'sign') }}:
{{ $gameLogInfoDetail->getGameInfoDetails()->getSign() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'headIconUrl') }}:
{{ $gameLogInfoDetail->getGameInfoDetails()->getHeadIconUrl() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'zoneId') }}:
{{ $gameLogInfoDetail->getGameInfoDetails()->getZoneId() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'create_at') }}:
{{ date("Y-m-d H:i:s",$gameLogInfoDetail->getGameInfoDetails()->getCreate_at()) }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'update_at') }}:
{{ date("Y-m-d H:i:s",$gameLogInfoDetail->getGameInfoDetails()->getUpdate_at()) }}<br>