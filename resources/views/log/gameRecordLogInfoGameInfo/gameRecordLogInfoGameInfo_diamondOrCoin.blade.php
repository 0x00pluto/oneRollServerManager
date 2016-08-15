{{--钻石，金币改变情况--}}
{{ trans('gameRecordLogInfoGameInfo.' . 'num') }}:
{{ $gameLogInfoDetail->getGameInfoDetails()->getNum() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'reason') }}:
{{ $gameLogInfoDetail->getGameInfoDetails()->getReason() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'nowNum') }}:
<del>{{ $gameLogInfoDetail->getGameInfoDetails()->getBefore() }}</del>
{{--{{ trans('gameRecordLogInfoGameInfo.' . 'after') }}:--}}
{{ $gameLogInfoDetail->getGameInfoDetails()->getAfter() }}<br>