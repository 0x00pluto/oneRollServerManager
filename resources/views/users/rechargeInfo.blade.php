@extends('users.index')
@section('body-content')
    <div>
        <div>
            <form class="form-horizontal" id="useridform" method="POST">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="userid" class="control-label col-md-3">
                        {{ trans('formname_query.'.'useridAndrestaurantName') }}:
                    </label>

                    <div class="col-md-9">
                        <input class="form-control" type="text" name="userid"
                               value="{{ old('userid') }}"
                               placeholder="{{ trans('formname_query.'.'useridAndrestaurantName') }}"
                               style="width: 400px">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn btn-lg btn-default">查询</button>
                    </div>
                </div>

            </form>
        </div>


        @if (isset($rechargeInfo))
            <div>
                <h4>用户统计充值信息</h4>

                <table class="table">
                    <tr>
                        <td>充值总金钱:</td>
                        <td>{{ $rechargeInfo->getTotalmoney()/100 }} 元</td>
                    </tr>
                </table>
                <h4>用户充值详细信息-完成订单</h4>
                <table class="table">
                    <tr>
                        <th class="col-sm-1">#</th>
                        <th class="col-sm-3">订单号</th>
                        <th class="col-sm-2">物品号
                        </th>
                        <th class="col-sm-2">创建时间
                        </th>
                        <th class="col-sm-1">钻石奖励
                        </th>
                    </tr>
                    @foreach($rechargeInfo->getCompleteOrderList() as $rechargeData)
                        <tr>
                            <td>{{ isset($index)? ++ $index :$index = 1 }}</td>
                            <td>{{ $rechargeData->getOrderId() }}</td>
                            <td>{{ $rechargeData->getGoodId() }}</td>
                            <td>{{ $rechargeData->getCreateTime() }}</td>
                            <td>{{ $rechargeData->getAwardDiamonds() }}</td>
                        </tr>
                    @endforeach
                </table>
                <h4>用户充值详细信息-未完成订单</h4>
                <table class="table">
                    <tr>
                        <th class="col-sm-1">#</th>
                        <th class="col-sm-3">订单号</th>
                        <th class="col-sm-2">物品号
                        </th>
                        <th class="col-sm-2">创建时间
                        </th>
                        <th class="col-sm-1">钻石奖励
                        </th>
                    </tr>
                    @foreach($rechargeInfo->getUnCompleteOrderList() as $rechargeData)
                        <tr>
                            <td>{{ isset($index)? ++ $index :$index = 1 }}</td>
                            <td>{{ $rechargeData->getOrderId() }}</td>
                            <td>{{ $rechargeData->getGoodId() }}</td>
                            <td>{{ $rechargeData->getCreateTime() }}</td>
                            <td>{{ $rechargeData->getAwardDiamonds() }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

        @else
            <h4 style="color: red">没有用户充值信息</h4>
        @endif

    </div>
@endsection