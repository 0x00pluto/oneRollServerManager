<!-- index -->
@extends('serverStatus.frame')
@section('body-content')

    <div class="row">
        <form class="form-horizontal col-md-offset-2 col-md-10"
              action="/gmtools/changServerStatus"
              method="post" id="submitForm">
            {!! csrf_field() !!}
            <div class="form-group col-md-10">
                <div class="col-md-3">
                    <label class="control-label">服务器状态</label>
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="serverStatus" onchange="submitQuery();">
                        <option value="1" {{ $serverStatus == "1"?"selected":"" }}> 开启</option>
                        <option value="0" {{ $serverStatus == "0"?"selected":"" }}> 关闭</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            增加新的服务器设置
        </button>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" method="post" action="/serverStatus/addServer"
                      id="addServerForm">
                    {!! csrf_field() !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">增加服务器设置</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                服务器名称
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="serverName" placeholder="服务器名称">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                服务器域名
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="url" name="serverHostName"
                                       placeholder="www.example.com">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                调用页面地址
                            </label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="apiUrl" placeholder="gmtoolsindex.php"
                                       value="gmtoolsindex.php">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="submitAddServer();">
                            Save
                            changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if(isset($serversInformation))

        @foreach($serversInformation as $serverInformation)

            <div class="row">
                <h4> 服务详细信息: {{ $serverInformation['general']->serverName }} </h4>
                <table class="table table-hover table-condensed">
                    <thead>
                    <tr>
                        <th class="col-md-3">
                            类型
                        </th>
                        <th class="col-md-9"> 值
                        </th>
                    </tr>
                    </thead>
                    <tr>
                        <td>
                            服务器地址:
                        </td>
                        <td>
                            {{ gethostbyname($serverInformation['general']->serverHostName) }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            API接口地址:
                        </td>
                        <td>
                            {{ $serverInformation['ApiUrl'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            服务器是否开启:
                        </td>
                        <td>
                            {{ $serverInformation['isOpen']?"是":"否" }}
                        </td>
                    </tr>

                    @foreach($serverInformation['Details'] as $key=>$value)
                        <tr>
                            <td>
                                {{ $key }}
                            </td>
                            <td>
                                {{ $value }}
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>

        @endforeach


    @endif

    <script>
        function submitQuery() {
            var submitForm = document.getElementById("submitForm");
            submitForm.submit();
        }
    </script>

    <script>
        $('#addServerForm').submit(
                function (e) {
                    var postData = $(this).serializeArray();
                    var formURL = $(this).attr("action");
                    $.ajax(
                            {
                                url: formURL,
                                type: "POST",
                                data: postData,
                                error: function (data) {
                                    console.log(data);

                                    if (data.status == 422) {
                                        var errors = $.parseJSON(data.responseText);
                                        console.log(errors);
                                    }
                                },
                                success: function (msg) {
                                    console.log(msg);
//                                        var datas = $.parseJSON(msg);
//                                        console.log(datas);
                                    $("#myModal").modal('hide');
                                }
                            }
                    );
                    e.preventDefault();
                }
        );
        function submitAddServer() {

            console.log("call submitAddServer");
            $('#addServerForm').submit(); //Submit  the FORM
        }

    </script>

@endsection

