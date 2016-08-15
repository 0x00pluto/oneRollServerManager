{{--钻石购买道具--}}
{{ trans('gameRecordLogInfoGameInfo.' . 'diamonds') }}:
{{ $gameLogInfoDetail->getGameInfoDetails()->getDiamonds() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'itemId') }}:
{{ $gameLogInfoDetail->getGameInfoDetails()->getItemId() }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'itemCount') }}:
{{ $gameLogInfoDetail->getGameInfoDetails()->getItemCount() }}