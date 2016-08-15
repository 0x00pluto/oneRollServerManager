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
        <!--
        ajax 代码 暂时不用
        <script>
            $("#useridform").submit(function (e) {
                var postData = $("#useridform").serialize();
                console.log(postData);
                console.log(formURL);
                console.log(method);
                $.ajax(
                        {
                            url: formURL,
                            type: "POST",
                            data: postData,
                            success: function (data) {

                                alert(data);
                            },
                            error: function (jqXHR) {
                                if (jqXHR.status == 422) {
                                    alert(jqXHR.responseText);
                                } else {
                                    alert('An error occurred while processing the request.');
                                }
                            }
                        }
                );
                e.preventDefault();
            });
        </script>
        -->
        <div>
            @if (isset($accountThirdPartyInfo))
                <h4>账号渠道信息</h4>
                <table class="table">
                    <tr>
                        <th class="col-md-2">字段</th>
                        <th class="col-md-10">数据</th>
                    </tr>
                    <tr>
                        <td>用户id</td>
                        <td>{{ $accountThirdPartyInfo['link_userid'] }}</td>
                    </tr>
                    <tr>
                        <td>用户名称</td>
                        <td>{{ $accountThirdPartyInfo->link_username }}</td>
                    </tr>
                    <tr>
                        <td>用户渠道</td>
                        <td>{{ $accountThirdPartyInfo->thirdpartytype }}</td>
                    </tr>
                    <tr>
                        <td>用户渠道登录名</td>
                        <td>{{ $accountThirdPartyInfo->username }}</td>
                    </tr>
                    <tr>
                        <td>用户渠道登录密码</td>
                        <td>{{ $accountThirdPartyInfo->password }}</td>
                    </tr>
                </table>

                @if(isset($account))
                    <h4>账号信息</h4>
                    <table class="table">
                        <tr>
                            <th class="col-md-2">字段</th>
                            <th class="col-md-10">数据</th>
                        </tr>
                        @foreach($account as $key=>$value)
                            <tr>
                                <td>{{ trans('modelname_account.'.$key) }}</td>
                                <td>{{ $value }}</td>
                            </tr>
                        @endforeach
                    </table>
                @else
                @endif

                @if (isset($role))
                    <h4>角色基本信息</h4>
                    <table class="table">
                        <tr>
                            <th class="col-md-2">字段</th>
                            <th class="col-md-10">数据</th>
                        </tr>
                        @foreach($role as $key=>$value)
                            <tr>
                                <td>{{ trans('modelname_role.'.$key) }}</td>
                                <td>{{ $value }}</td>
                            </tr>
                        @endforeach
                    </table>
                @elseif(!isset($role))
                    <h4>没有角色信息</h4>
                @else
                @endif

                @if (isset($restaurant))
                    <h4>餐厅信息</h4>
                    <table class="table">
                        <tr>
                            <th class="col-md-2">字段</th>
                            <th class="col-md-10">数据</th>
                        </tr>
                        @foreach($restaurant as $key=>$value)

                            <tr>
                                <td>{{ trans('modelname_restaurant.'.$key) }}</td>
                                <td>{{ $value }}</td>
                            </tr>

                        @endforeach
                    </table>
                @elseif(!isset($restaurant))
                    <h4 style="color: red">没有餐厅信息</h4>
                @else
                @endif

                @if (isset($vip))
                    <h4>Vip信息</h4>
                    <table class="table">
                        <tr>
                            <th class="col-md-2">字段</th>
                            <th class="col-md-10">数据</th>
                        </tr>

                        @foreach($vip['viplevelinfo'] as $key=>$value)

                            <tr>
                                <td>{{ trans('modelname_vip.'.$key) }}</td>
                                {{--<td>{{ ($key) }}</td>--}}
                                <td>{{ $value }}</td>
                            </tr>

                        @endforeach
                    </table>
                @elseif(!isset($vip))
                @else
                @endif


                @if(isset($deviceinfo))
                    <h4>设备信息</h4>
                    <table class="table">
                        <tr>
                            <th class="col-md-2">字段</th>
                            <th class="col-md-10">数据</th>
                        </tr>
                        @foreach($deviceinfo as $key => $value)
                            <tr>
                                <td>{{ trans('modelname_device.'.$key) }}</td>
                                @if($value == 1)
                                    <td>android</td>
                                @elseif($value == 2)
                                    <td>iPhone</td>
                                @else
                                    <td>{{ $value }}</td>
                                @endif
                            </tr>
                        @endforeach
                    </table>
                @else
                    <h4 style="color: red">没有设备信息</h4>
                @endif

            @else
                <p>没有找到用户</p>
            @endif
        </div>

    </div>

@endsection
