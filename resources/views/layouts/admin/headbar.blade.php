@section('header-bar')
    <p>餐厅后台管理系统.
        @if (Auth::check())
            当前用户: {{ Auth::user()->name}} <a href="/auth/logout"> 注销 </a>
        @endif</p>
@endsection
