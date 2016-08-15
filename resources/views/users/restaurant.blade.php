@extends('users.index') @section('body-content')
    <div>
        <form method="POST" class="form-horizontal">
            {!! csrf_field() !!}
            <div class="form-group">

                <label for="userid" class="col-md-3 control-label">
                    {{ trans('formname_query.'.'useridAndrestaurantName') }}:
                </label>

                <div class="col-md-9">
                    <input type="text" style="width: 400px" name="userid"
                           value="{{ old('userid') }}" class="form-control">
                </div>
            </div>
            <div class="form-group form-inline">
                <label for="exp" class="col-md-3 control-label">增加的餐厅经验:</label>

                <div class="col-md-9">
                    <input type="text" style="width: 400px" name="exp" value="0" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn">修改</button>
                </div>
            </div>
        </form>

        @if(isset($oldData))
            <div>
                <h2>修改成功!!</h2>

                <h3>数据变化</h3>
                <table class="table">
                    <tr>
                        <th>字段</th>
                        <th>数据</th>
                    </tr>
                    @foreach($newData as $key=>$value)
                        <tr {{ $oldData[$key]!= $value?'class=warning':'' }}>
                            <td>{{ trans('modelname_restaurant.'.$key) }}</td>
                            <td>{!! $oldData[$key]!= $value?"<del>".$oldData[$key]."</del>":'' !!} {{ $value }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endif
    </div>
@endsection
