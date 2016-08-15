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
                <label for="itemId" class="col-md-3 control-label">增加道具ID:</label>

                <div class="col-md-9">
                    <input type="text" style="width: 400px" name="itemId" value="{{ old('itemId') }}"
                           class="form-control">
                </div>
            </div>
            <div class="form-group form-inline">
                <label for="itemCount" class="col-md-3 control-label">增加道具数量:</label>

                <div class="col-md-9">
                    <input type="text" style="width: 400px" name="itemCount" value="{{ old('itemCount') }}"
                           class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn">增加道具</button>
                </div>
            </div>
        </form>

        @if(isset($result))
            <div>
                <h2>修改结果!!</h2>

                @if($result->is_succ())
                    <h3> 增加成功</h3>
                @else
                    <h3> 增加失败!</h3>
                    {{ dump($result) }}
                @endif


            </div>
        @endif
    </div>
@endsection
