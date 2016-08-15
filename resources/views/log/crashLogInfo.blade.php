@extends('log.index')
@section('body-content')
    <div>
        <div>
            {{-- 表单模块 --}}
            <form method="POST" class="form-horizontal" id="queryForm">
                {!! csrf_field() !!}
                {{--<div class="form-group">--}}
                {{--<label for="query_time" class="control-label col-md-3" type="hidden">--}}
                {{--{{ trans('crashLogInfo.'.'time') }}:--}}
                {{--</label>--}}

                {{--<div class="col-md-9">--}}
                {{--<input class="form-control" type="text" name="query_time"--}}
                {{--value="{{ old('query_time') }}"--}}
                {{--placeholder="{{ trans('crashLogInfo.'.'time') }}"--}}
                {{--style="width: 400px" type="hidden">--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="form-group">
                    <label for="query_luaVersion" class="control-label col-md-3">
                        {{ trans('crashLogInfo.'.'luaVersion') }}:
                    </label>

                    <div class="col-md-2">
                        {{-- lua版本是否存在--}}
                        @if(isset($luaVersionArr))
                            <select class="form-control" name="query_luaVersion" id="queryLuaVersion"
                                    onchange="submitQuery(1);">

                                <option value="">全部版本</option>
                                {{-- 显示lua版本数据--}}
                                @foreach($luaVersionArr as  $value)
                                    <option value="{{ $value }}"
                                            {{--判断是否是选中状态--}}
                                            {{ $value == old('query_luaVersion')?"selected=selected":null}}>

                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>

                        @else
                            <p>无版本号</p>
                        @endif

                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-lg btn-default" onclick="submitQuery(1)">刷新</button>
                    </div>
                </div>
                {{--<div class="form-group">--}}
                {{--<div class="col-md-offset-3 col-md-9">--}}
                {{--<button class="btn" onclick="submitQuery(1)">查询</button>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--js提交form表单--}}
                <script>
                    function submitQuery(pageIndex) {
                        var submitForm = document.getElementById("queryForm");
                        var input = document.createElement("input");
                        input.setAttribute("type", "hidden");
                        input.setAttribute("name", 'page');
                        input.setAttribute("value", pageIndex);
                        submitForm.appendChild(input);
                        submitForm.submit();
                    }
                </script>
            </form>
        </div>
        <!-- 显示视图部分 -->
        @if(isset($CrashLineChartInfos))
            <div class="row">
                <div class="col-md-12">
                    <canvas id="myChart" height="400" width="800"></canvas>
                </div>
            </div>
            <script>
                var data = {
                    labels: {!! json_encode(array_keys($CrashLineChartInfos)) !!},
                    datasets: [
                        {
                            fillColor: "rgba(220,220,220,0.5)",
                            strokeColor: "rgba(220,220,220,1)",
                            pointColor: "rgba(220,220,220,1)",
                            pointStrokeColor: "#fff",
                            data: {!! json_encode(array_values($CrashLineChartInfos)) !!}



                        }
                    ]
                };

                var ctx = document.getElementById("myChart").getContext("2d");
                var myNewChart = new Chart(ctx).Line(data);
            </script>
        @endif


        <div>
            @if(isset($crashLogInfoGroup))
                <div>
                    <h2>客户端崩溃日志</h2>
                </div>
                <div>


                    <table class="table table-hover table-condensed" id="tableSort">
                        <thead>
                        <tr>
                            <th class="col-sm-1" onclick="tableSort('tableSort',1,'int');" style="cursor: pointer;">
                                {{ trans('crashLogInfo.'.'number') }}
                            </th>
                            <th class="col-sm-1" onclick="tableSort('tableSort',2,'string');"
                                style="cursor: pointer;">
                                <span class="caret"></span>
                                状态
                            </th>
                            <th class="col-md-1">标记</th>
                            {{--<th class="col-sm-1" onclick="tableSort('tableSort',1,'string');"--}}
                            {{--style="cursor: pointer;"> 状态 </th>--}}
                            <th class="col-md-5">
                                {{ trans('crashLogInfo.'.'message') }}
                            </th>
                            <th class="col-md-1" onclick="tableSort('tableSort',5,'int')"
                                style="cursor: pointer;">{{ trans('crashLogInfo.'.'count') }}<span class="caret"></span>
                            </th>
                            <th class="col-md-2" onclick="tableSort('tableSort',6,'date')"
                                style="cursor: pointer;">{{ trans('crashLogInfo.'.'time') }}<span class="caret"></span>
                            </th>
                            <th class="col-md-1">{{ trans('crashLogInfo.'.'luaVersion') }}</th>

                            {{--                            <th class="col-md-1">{{ trans('crashLogInfo.'.'cppVersion') }}</th>--}}
                            {{--<th class="col-md-1">{{ trans('crashLogInfo.'.'deviceType') }}</th>--}}
                        </tr>
                        </thead>

                        {{--显示崩溃信息--}}
                        @foreach($crashLogInfoGroup->getCrashLogGroupDetails() as $CrashLogGroupKey
                                => $CrashLogGroupDetail)


                            @if(\App\CookAdmin\ClientCrashOptions::createOptions($CrashLogGroupKey)->isResolve())
                                <tr id="crashRow_{{ $CrashLogGroupKey }}" class="success">
                            @elseif(\App\CookAdmin\ClientCrashOptions::createOptions($CrashLogGroupKey)->isMarkFlag())
                                <tr id="crashRow_{{ $CrashLogGroupKey }}" class="warning">
                            @else
                                <tr id="crashRow_{{ $CrashLogGroupKey }}">
                                    @endif

                                    <td style="vertical-align: middle">
                                        {{ isset($CrashIndex)?++$CrashIndex:$CrashIndex = 1 }}
                                    </td>
                                    {{--显示崩溃信息序号--}}
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"
                                                       id="checkboxResolveMark_{{ $CrashLogGroupKey }}"
                                                       {{ \App\CookAdmin\ClientCrashOptions::createOptions($CrashLogGroupKey)->isResolve()?"checked":"" }}
                                                       onclick="markResolve('{{ $CrashLogGroupKey }}');"
                                                > 解决
                                            </label>
                                        </div>
                                    </td>
                                    <td hidden>
                                        解决

                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"
                                                       id="checkboxMarkFlag_{{ $CrashLogGroupKey }}"
                                                       {{ \App\CookAdmin\ClientCrashOptions::createOptions($CrashLogGroupKey)->isMarkFlag()?"checked":"" }}
                                                       onclick="markFlag('{{ $CrashLogGroupKey }}');"
                                                > 挂起
                                            </label>
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle">

                                        <a target="_blank"
                                           href="/logQuery/crashLogQueryStack/{{ $CrashLogGroupKey }}/{{$CrashLogGroupDetail->getCrashLuaVersion()}}"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{ $CrashLogGroupDetail->getTipCrashLogInfo()->getCrashMessage() }}">
                                            <div id="crashDivName_{{ $CrashLogGroupKey }}_del" {{!\App\CookAdmin\ClientCrashOptions::createOptions($CrashLogGroupKey)->isResolve()?"hidden":""}}>
                                                <del>{{ substr($CrashLogGroupDetail->getTipCrashLogInfo()->getCrashMessage(),0,80) . '...' }}</del>
                                            </div>
                                            <div id="crashDivName_{{ $CrashLogGroupKey }}" {{\App\CookAdmin\ClientCrashOptions::createOptions($CrashLogGroupKey)->isResolve()?"hidden":""}}>
                                                {{ substr($CrashLogGroupDetail->getTipCrashLogInfo()->getCrashMessage(),0,80) . '...' }}
                                            </div>
                                        </a>
                                    </td>
                                    <td style="vertical-align: middle">

                                        {{ count($CrashLogGroupDetail->getCrashLogInfos()) }}

                                    </td>
                                    <td style="vertical-align: middle">
                                        {{ $CrashLogGroupDetail->getTipCrashLogInfo()->getCrashInfo()->getTime() }}
                                    </td>
                                    <td style="vertical-align: middle">
                                        {{ $CrashLogGroupDetail->getTipCrashLogInfo()->getCrashInfo()
                                        ->getLuaVersion() }}
                                    </td>
                                    {{--<td style="vertical-align: middle">--}}
                                    {{--{{ $CrashLogGroupDetail->getTipCrashLogInfo()->getCrashInfo()--}}
                                    {{--->getCppVersion() }}--}}
                                    {{--</td>--}}
                                    {{--<td style="vertical-align: middle">--}}
                                    {{--{{ $CrashLogGroupDetail->getTipCrashLogInfo()->getCrashInfo()--}}
                                    {{--->getDeviceInfo()->getDeviceType() }}--}}
                                    {{--</td>--}}

                                </tr>
                                @endforeach
                    </table>
                </div>
            @else

                {{--<div>--}}
                {{--<p class="text-warning">没有崩溃信息</p>--}}
                {{--</div>--}}
            @endif


            <script>
                /**
                 * 根据返回数据,标记行的颜色
                 * @param $data
                 */
                function markRowColorByData($data) {
                    var crashId = $data.crashId;
                    var resolve = $data.resolve;
                    var markFlag = $data.markFlag;

                    var crashRow = document.getElementById("crashRow_" + crashId);
                    if (resolve) {
                        crashRow.setAttribute("class", "success")
                    }
                    else if (markFlag) {
                        crashRow.setAttribute("class", "warning")
                    }
                    else {
                        crashRow.setAttribute("class", "")
                    }

                }
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
                            var crashDivName = document.getElementById("crashDivName_" + $crashId);
                            var crashDivNameDel = document.getElementById("crashDivName_" + $crashId + "_del");
//                            var crashRow = document.getElementById("crashRow_" + $crashId);
                            if (resolve.checked) {
                                crashDivName.setAttribute("hidden", true);
                                crashDivNameDel.removeAttribute("hidden");
//                                crashRow.setAttribute("class", "success")
                            }
                            else {
                                crashDivName.removeAttribute("hidden");
                                crashDivNameDel.setAttribute("hidden", true);
//                                crashRow.setAttribute("class", "")
                            }

                            markRowColorByData(msg);
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
                            var errors = $.parseJSON(data.responseText)
                            console.log(errors);
                        },
                        success: function (msg) {
                            console.log(msg)
//                                var crashDivName = document.getElementById("crashDivName_" + $crashId);
//                                var crashDivNameDel = document.getElementById("crashDivName_" + $crashId + "_del");
//                                if (resolve.checked) {
//                                    crashDivName.setAttribute("hidden", true);
//                                    crashDivNameDel.removeAttribute("hidden");
//                                }
//                                else {
//                                    crashDivName.removeAttribute("hidden");
//                                    crashDivNameDel.setAttribute("hidden", true);
//                                }
                            markRowColorByData(msg);
                        }
                    })
                }


            </script>

            <script>

                function convert(sValue, sDataType) {
                    switch (sDataType) {
                        case   "int" :
                            return parseInt(sValue);
                        case   "float" :
                            return parseFloat(sValue);
                        case   "date" :
                            return new Date(Date.parse(sValue));
                        default :
                            return sValue.toString();
                    }
                }

                function tableSort(tableId, Idx, dataType) {
                    var table = document.getElementById(tableId);
                    var tbody = table.tBodies[0];
                    var tr = tbody.rows;

                    var trValue = [];
                    for (var i = 0; i < tr.length; i++) {
                        trValue[i] = tr[i];  //将表格中各行的信息存储在新建的数组中
                    }

                    if (tbody.sortCol == Idx) {
                        trValue.reverse(); //如果该列已经进行排序过了，则直接对其反序排列
                    } else {
                        //trValue.sort(compareTrs(Idx));  //进行排序
                        trValue.sort(function (tr1, tr2) {

                            var value1 = convert(tr1.cells[Idx].innerHTML, dataType);
                            var value2 = convert(tr2.cells[Idx].innerHTML, dataType);
                            if (dataType == "string") {
                                return value1.localeCompare(value2);
                            }

                            if (value1 > value2) {
                                return 1;
                            }
                            else if (value1 < value2) {
                                return -1;
                            }
                            return 0;
                        });
                    }

                    var fragment = document.createDocumentFragment();  //新建一个代码片段，用于保存排序后的结果
                    for (var i = 0; i < trValue.length; i++) {
                        fragment.appendChild(trValue[i]);
                    }

                    tbody.appendChild(fragment); //将排序的结果替换掉之前的值
                    tbody.sortCol = Idx;
                }
            </script>
        </div>
    </div>
@endsection
