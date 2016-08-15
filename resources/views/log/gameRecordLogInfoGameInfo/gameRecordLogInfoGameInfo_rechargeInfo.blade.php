{{--充值信息--}}
订单信息：<br>

{{ trans('gameRecordLogInfoGameInfo.' . 'orderId') }}:
{{ $gameLogInfoDetail->getGameInfoDetails()->getOrderData()['orderid'] }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'goodsId') }}:
{{ $gameLogInfoDetail->getGameInfoDetails()->getOrderData()['goodsid'] }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'isComplete') }}:
{{ $gameLogInfoDetail->getGameInfoDetails()->getOrderData()['iscomplete'] }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'orderCreateTime') }}:
{{ date('Y-m-d H:i:s',$gameLogInfoDetail->getGameInfoDetails()->getOrderData()['createtime'] )}}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'awardDiamonds') }}:
{{ $gameLogInfoDetail->getGameInfoDetails()->getOrderData()['awarddiamonds']}}<br>

充值信息：<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'rmb') }}:
{{ $gameLogInfoDetail->getGameInfoDetails()->getRechargeData()['rmb'] }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'rechargeDiamond') }}:
{{ $gameLogInfoDetail->getGameInfoDetails()->getRechargeData()['diamond'] }}<br>
{{ trans('gameRecordLogInfoGameInfo.' . 'exp') }}:
{{ $gameLogInfoDetail->getGameInfoDetails()->getRechargeData()['exp'] }}