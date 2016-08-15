@extends('log.index')
@section('body-content')
    <script>
        {{--{!! csrf_field() !!}--}}



        function markResolve($crashId) {


            var resolve = document.getElementById("checkboxResolveMark_" + $crashId);
            $.ajax({
                url: "/logQuery/markResolveOrNot",
                method: "POST",
                data: {
                    crashId: $crashId,
                    Resolve: resolve.checked ? 1 : 0,
                    _token: "{{ csrf_token () }}"
                },
                error: function (data) {
                    console.log(data);
                    if (data.status == 422) {
                        var errors = $.parseJSON(data.responseText);
                        console.log(errors);
                    }
                },
                success: function (msg) {
                    console.log(msg)

                }
            })
        }
        {{--{!! csrf_field() !!}--}}
        function markFlag($crashId) {

            var resolve = document.getElementById("checkboxMarkFlag_" + $crashId);
            $.ajax({
                url: "/logQuery/markCrashWithFlagOrNo",
                method: "POST",
                data: {
                    crashId: $crashId,
                    markFlag: resolve.checked ? 1 : 0,
                    _token: "{{ csrf_token () }}"
                },
                error: function (data) {
                    console.log(data);
                    if (data.status == 422) {
                        var errors = $.parseJSON(data.responseText);
                        console.log(errors);
                    }
                },
                success: function (msg) {
                    console.log(msg)
                }
            })
        }
    </script>
    @if(isset($crashLogInfoGroup))
        <div>
            <h2>客户端崩溃日志</h2>

            <h4>  {{ $crashLogInfoGroup->getTipCrashLogInfo()->getCrashMessage() }}</h4>


            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Crash状态:&nbsp;<label>
                            是否解决
                            <input type="checkbox"
                                   id="checkboxResolveMark_{{ $crashLogInfoGroup->getCrashKey() }}"
                                   {{ \App\CookAdmin\ClientCrashOptions::createOptions($crashLogInfoGroup->getCrashKey())->isResolve()?"checked":"" }}
                                   onclick="markResolve('{{ $crashLogInfoGroup->getCrashKey() }}');"
                            >
                        </label> &nbsp;&nbsp;
                        <label>
                            是否挂起
                            <input type="checkbox"
                                   id="checkboxMarkFlag_{{ $crashLogInfoGroup->getCrashKey() }}"
                                   {{ \App\CookAdmin\ClientCrashOptions::createOptions($crashLogInfoGroup->getCrashKey())->isMarkFlag()?"checked":"" }}
                                   onclick="markFlag('{{ $crashLogInfoGroup->getCrashKey() }}');"
                            >
                        </label> &nbsp;&nbsp;
                        堆栈信息如下
                    </h3>
                </div>
                <div class="panel-body">
                    <p class="navbar-text">
                        @foreach( explode("\n",$crashLogInfoGroup->getTipCrashLogInfo()->getCrashInfo()->getStack()) as $stack)

                            {!! $stack !!} <br/>

                        @endforeach
                    </p>
                </div>
            </div>
            {{--程序信息--}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        {{ trans('crashLogInfo.'.'programInfo') }}
                    </h3>
                </div>
                <div class="panel-body">
                    <p class="navbar-text">
                        {{ trans('crashLogInfo.'.'luaVersion') }}:
                        {{ $crashLogInfoGroup->getTipCrashLogInfo()->getCrashInfo()->getLuaVersion() }}<br>
                        {{ trans('crashLogInfo.'.'cppVersion') }}:
                        {{ $crashLogInfoGroup->getTipCrashLogInfo()->getCrashInfo()->getCppVersion() }}<br>
                        {{ trans('crashLogInfo.'.'code') }}:
                        {{ $crashLogInfoGroup->getTipCrashLogInfo()->getCrashInfo()->getCode() }}<br>
                        {{ trans('crashLogInfo.'.'clientVersion') }}:
                        {{ $crashLogInfoGroup->getTipCrashLogInfo()->getCrashInfo()->getClientVersion() }}
                    </p>
                </div>
            </div>
            <table class="table table-hover table-condensed">
                <tr>
                    <th class="col-md-1">{{ trans('crashLogInfo.'.'number') }}</th>
                    <th class="col-md-3">{{ trans('crashLogInfo.'.'message') }}</th>
                    <th class="col-md-2">{{ trans('crashLogInfo.'.'time') }}</th>
                    <th class="col-md-2">{{ trans('crashLogInfo.'.'deviceInfo') }}</th>
                </tr>
                @foreach($crashLogInfoGroup->getCrashLogInfoMergeByMessage() as $crashLogInfos)
                    <tr class="warning">
                        <td style="vertical-align: middle">
                            {{ $number++ }}
                        </td>
                        <td style="vertical-align: middle">
                            {{ $crashLogInfos->getMessage() }}
                        </td>
                        <td style="vertical-align: middle">

                            {{ $crashLogInfos->getCrashInfo()->getTime() }}

                        </td>
                        {{--设备信息--}}
                        <td style="vertical-align: middle">
                            {{ trans('crashLogInfo.'.'systemVersion') }}:
                            {{ $crashLogInfos->getCrashInfo()->getDeviceInfo()->getSystemVersion() }}<br>
                            {{ trans('crashLogInfo.'.'deviceName') }}:
                            {{ $crashLogInfos->getCrashInfo()->getDeviceInfo()->getDeviceName() }}<br>
                            {{ trans('crashLogInfo.'.'deviceGPUMem') }}:
                            {{ $crashLogInfos->getCrashInfo()->getDeviceInfo()->getDeviceGPUMem()}}<br>
                            {{ trans('crashLogInfo.'.'deviceId') }}:
                            {{ $crashLogInfos->getCrashInfo()->getDeviceInfo()->getDeviceId()}}<br>
                            {{ trans('crashLogInfo.'.'deviceType') }}:
                            {{ $crashLogInfos->getCrashInfo()->getDeviceInfo()->getDeviceType() }}<br>
                            {{ trans('crashLogInfo.'.'deviceCPU') }}:
                            {{ $crashLogInfos->getCrashInfo()->getDeviceInfo()->getDeviceCPU() }}<br>
                            {{ trans('crashLogInfo.'.'deviceMem') }}:
                            {{ $crashLogInfos->getCrashInfo()->getDeviceInfo()->getDeviceMem() }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>


    @else
        <div>
            <p class="text-warning">没有崩溃信息</p>
        </div>
    @endif

@endsection
