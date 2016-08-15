{{--新手引导开启，关闭情况--}}
{{ trans('gameRecordLogInfoGameInfo.' . 'userGuide') }}:
{{ $gameLogInfoDetail->getGameInfoDetails()->getUserGuide() }}