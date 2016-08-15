@extends('users.index') @section('body-content')
    <div>
        <form class="form-horizontal" action="/user/diamond" id="usreidform" method="post">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="usreid" class="control-label col-md-3">
                    {{ trans('formname_query.'.'useridAndrestaurantName') }}:
                </label>

                <div class="col-md-9">
                    <input class="form-control" type="text" name="userid"
                           value="{{ old('userid') }}"
                           placeholder="{{ trans('formname_query.'.'useridAndrestaurantName') }}"
                           style="width: 400px">
                </div>
            </div>

            <div class="form-group form-inline">
                <label for="diamond" class="col-md-3 control-label">需要增加的钻石数量:</label>

                <div class="col-md-9">
                    <input type="text" style="width: 400px" name="diamond" value="0" class="form-control">
                </div>
            </div>

            <div class="form-group form-inline">
                <label for="gamecoin" class="col-md-3 control-label">需要增加的游戏币数量:</label>

                <div class="col-md-9">
                    <input type="text" style="width: 400px" name="gamecoin" value="0" class="form-control">
                </div>
            </div>

            <div class="form-group form-inline">
                <label for="reducediamond" class="col-md-3 control-label">需要减少的钻石数量:</label>

                <div class="col-md-9">
                    <input type="text" style="width: 400px" name="reducediamond" value="0" class="form-control">
                </div>
            </div>

            <div class="form-group form-inline">
                <label for="reducegamecoin" class="col-md-3 control-label">需要减少的游戏币数量:</label>

                <div class="col-md-9">
                    <input type="text" style="width: 400px" name="reducegamecoin" value="0" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">

                    <button type="submit" class="btn btn-lg btn-default">修改</button>
                </div>
            </div>

        </form>
    </div>
    <div>
        @if(isset($oldrole))
            <h2>修改成功!!</h2>

            <h3>数据变化</h3>
            <table class="table">
                <tr>
                    <th>字段</th>
                    <th>数据</th>
                </tr>
                @foreach($newrole as $key=>$value)
                    <tr {{ $oldrole[$key] != $value?'class=warning':'' }}>
                        <td>{{ trans('modelname_role.' . $key) }}</td>
                        <td>{!! $oldrole[$key] != $value?"<del>" . $oldrole[$key] . "</del>":'' !!} {{ $value }}</td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>

@endsection
