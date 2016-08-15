@extends('log.index')
@section('body-content')
    <div>
        <div>
            <!--表单部分-->
            <form action="/logQuery/gameRecordLogQuery/" method="post" class="form-horizontal" id="queryForm">
                {!! csrf_field() !!}
                {{--本地化地址--}}
                <p hidden>{{ $gameRecordLogInfo = 'gameRecordLogInfo.' }}</p>
                {{--传递消息类型给后台--}}
                <input type="hidden" value="{{ isset($query_type)?$query_type:null }}" name="query_type">
                {{--@if(isset($gameLogType))
                <div class="form-group">
                    <label for="query_type" class="control-label col-md-3">
                        {{ trans($gameRecordLogInfo .'type') }}:
                    </label>
                    <div class="col-md-2">
                        --}}{{-- 游戏类型是否存在--}}{{--
                            <select class="form-control" name="query_type" id="queryLuaVersion"
                                    onchange="submitQuery(1);">

                                <option value="">{{ trans($gameRecordLogInfo . 'allType') }}</option>
                                --}}{{-- 显示游戏类型--}}{{--
                                @foreach($gameLogType as   $gameTypeValue)
                                    <option value="{{ $gameTypeValue }}"
                                            {{ $gameTypeValue == old('query_type')?"selected=selected":null }}>
                                        {{ trans($gameRecordLogInfo . $gameTypeValue)}}
                                    </option>
                                @endforeach
                            </select>
                    </div>
                </div>
                @endif--}}
                <div class="form-group">
                    <label for="query_userId" class="control-label col-md-3">
                        {{ trans($gameRecordLogInfo.'userId') }}:
                    </label>
                    <div class="col-md-5">
                        <input class="form-control" type="text" name="query_userId"
                               value="{{ old('query_userId') }}"
                               placeholder="{{ trans($gameRecordLogInfo.'userId')  }}"
                               style="width: 400px">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-5">
                        <button class="btn" type="submit">查询</button>
                    </div>
                </div>
                <div>
                    <input type="button" class="btn btn-primary" onclick="javascript:exportExcel('TableExcel');"
                           value="导入到EXCEL">
                </div>
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
        <!--显示部分-->
        <div>
            <div>
                <h2>{{ trans($gameRecordLogInfo.'gameRecordLog') }}</h2>
            </div>
            {{--序号赋值--}}
            <p hidden>{{ $order = 1 }}</p>
            <div>
                @if(!empty($gameRecordAllInfo))
                    <table id="TableExcel" class="table table-hover table-condensed">
                        <tr>
                            <th class="col-sm-1">{{ trans($gameRecordLogInfo . 'order') }}</th>
                            {{--<th class="col-md-1">{{ trans($gameRecordLogInfo . 'messageType') }}</th>--}}
                            <th class="col-md-3">{{ trans($gameRecordLogInfo . 'userId') }}</th>
                            <th class="col-md-1">{{ trans($gameRecordLogInfo . 'datetime') }}</th>
                            <th class="col-md-6">详细信息</th>
                        </tr>
                        @foreach($gameRecordAllInfo as $gameRecordInfo)
                            <tr class="warning">
                                <td style="vertical-align: middle">{{ $order++ }}</td>
                                @if(!empty($messageType = explode(' ',$gameRecordInfo->getMessage())))
                                    {{--<td style="vertical-align: middle">--}}
                                    {{--<a target="_blank"--}}
                                    {{--href="/logQuery/gameRecordLogQueryContext/{{--}}
                                    {{--$gameRecordInfo->getGameRecordId() }}"--}}

                                    {{--data-toggle="tooltip"--}}
                                    {{--data-placement="top"--}}
                                    {{--title="{{  $messageType[0] }}">--}}
                                    {{--显示messageType--}}
                                    {{--{{ $messageType[0] }}--}}
                                    {{--</a>--}}
                                    {{--</td>--}}
                                    {{--显示userid--}}
                                    <td style="vertical-align: middle">
                                        <a target="_blank"
                                           href="/logQuery/gameRecordLogQueryContext/{{
                                           $gameRecordInfo->getGameRecordId() }}"

                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{  $messageType[0] }}">
                                            {{--显示userid--}}
                                            {{ $messageType[1] }}
                                        </a>
                                    </td>
                                @endif
                                <td style="vertical-align: middle">
                                    {{ $gameRecordInfo->getDateTime() }}
                                </td>
                                <td style="vertical-align: middle">
                                    <p>
                                        {{ $gameRecordInfo->getDetailMessage() }}
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{--分页模块--}}
                    <div>
                        总记录数为：{{ $pages->total() }}条
                        总页数：{{ $pages->lastPage() }} 页
                        当前是第：{{ $pages->currentPage() }}页
                        <nav>
                            <ul class="pagination">
                                {{--前一页--}}
                                <li class={{ $pages->currentPage()==1?"disabled":null }}>
                                    <a href="javascript:submitQuery({{ $pages->currentPage()-1 }});"
                                       aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                {{--显示分页--}}
                                @for($i=1;$i<=$pages->lastPage();$i++)
                                    {{--选中的样式--}}
                                    <li class={{ $pages->currentPage()==$i?"active":null }}>
                                        <a href="javascript:submitQuery({{ $i }});">{{ $i }}
                                            <span class="sr-only">(current)</span>
                                        </a>
                                    </li>
                                @endfor
                                {{--后一页--}}
                                <li class={{ $pages->currentPage()==$pages->lastPage()?"disabled":null }}>
                                    <a href="javascript:submitQuery({{ $pages->currentPage()+1 }});" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
            </div>
            <div>
                @else
                    无日志信息
                @endif
            </div>
        </div>
    </div>
    {{--js导出excel--}}
    <script>
        function exportExcel(tableid) //读取表格中每个单元到EXCEL中
        {
            var curTbl = document.getElementById(tableid);

            var oXL = new ActiveXObject("Excel.Application");

            //创建AX对象excel
            var oWB = oXL.Workbooks.Add();
            //获取workbook对象
            var oSheet = oWB.ActiveSheet;
            //激活当前sheet
            var Lenr = curTbl.rows.length;

            //取得表格行数
            for (i = 0; i < Lenr; i++) {
                var Lenc = curTbl.rows(i).cells.length;
                //取得每行的列数
                for (j = 0; j < Lenc; j++) {
                    oSheet.Cells(i + 1, j + 1).value = curTbl.rows(i).cells(j).innerText;
                    //赋值
                }
            }
            oXL.Visible = true;
            //设置excel可见属性
        }
    </script>
@endsection