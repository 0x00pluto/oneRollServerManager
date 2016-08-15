@extends('users.index')
@section('body-content')
    <div>

        <div>
            <form class="form-horizontal" id="userNameForm" method="POST">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="username" class="control-label col-md-3">
                        用户名称:
                    </label>

                    <div class="col-md-9">
                        <input class="form-control" type="text" name="username"
                               value="{{ old('username') }}"
                               placeholder="用户名称"
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

        @if(isset($accounts))
            <div>
                <h4>用户信息</h4>
                <table class="table table-striped">
                    <tr>
                        <th class="col-sm-1">#</th>
                        <th class="col-md-2">用户名</th>
                        <th class="col-md-1">餐厅等级</th>
                        <th class="col-md-3">用户ID</th>
                        <th class="col-md-1">是否已经删除</th>
                        <th class="col-md-4">最后上线时间</th>
                    </tr>
                    @foreach($accounts as $key=>$account)
                        {{--@if(null !== $account->restaurant())--}}
                        <tr class="{{ $account->account()->isdelete?"danger":"" }}">
                            <td>{{ isset($index)? ++ $index :$index = 1 }}</td>
                            <td>{{ $account->rolename }}</td>
                            <td>{{ (null !== $account->restaurant())?$account->restaurant()->restaurantlevel:"暂无餐厅等级信息" }}</td>
                            <td>{{ $account->userid }}</td>
                            <td>{{ $account->account()->isdelete?"是":"否" }}
                            <td>{{ $account->lastest_logintime }}</td>
                        </tr>
                        {{--@endif--}}
                    @endforeach

                </table>
            </div>
        @endif
    </div>




@endsection
