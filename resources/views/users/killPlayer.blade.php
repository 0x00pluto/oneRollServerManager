@extends('users.index')
@section('body-content')
    <div>
        <form method="POST" class="form-horizontal">
            {!! csrf_field() !!}
            <div class="form-group">

                <label for="userid" class="col-md-3 control-label">
                    {{ trans('formname_query.'.'userid') }}:
                </label>

                <div class="col-md-9">
                    <input type="text" style="width: 400px" name="userid"
                           value="{{ old('userid') }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn">删除用户</button>
                </div>
            </div>
        </form>

        @if(isset($result))
            <div>
                <h2>修改结果!!</h2>

                @if($result->is_succ())
                    <h3> 删除成功</h3>
                @else
                    <h3> 删除失败!</h3>
                    {{ dump($result) }}
                @endif


            </div>
        @endif

    </div>
@endsection