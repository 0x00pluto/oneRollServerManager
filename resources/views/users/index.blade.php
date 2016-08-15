@extends('layouts.admin.frame') @section('title','用户管理')
@section('body-content')
<p>欢迎来到用户管理页面</p>
@endsection


@section('footer-bar')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection

