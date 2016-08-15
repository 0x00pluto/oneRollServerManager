<!DOCTYPE html>
<!-- Stored in resources/views/layouts/mastertemplate.blade.php -->

<html lang="zh-CN">
<head>
    <title>管理后台-@yield('title')</title>

    <link rel="stylesheet" href="{{ URL::asset('/') }}assets/css/laravel.css">


    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    {{--<link rel="stylesheet" href="https://necolas.github.io/normalize.css/3.0.2/normalize.css">--}}


    <!-- 可选的Bootstrap主题文件（一般不用引入） -->
    {{--<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">--}}

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


    {{--<link rel="stylesheet" type="text/css" href="{{ URL::asset('/') }}assets/js/jeasyui/themes/default/easyui.css">--}}
    {{--<link rel="stylesheet" type="text/css" href="{{ URL::asset('/') }}assets/js/jeasyui/themes/icon.css">--}}

    <script src="{{ URL::asset('/') }}assets/js/Chart.min.js"></script>
    {{--<script src="{{ URL::asset('/') }}assets/js/jeasyui/jquery.easyui.min.js"></script>--}}

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="docs language-php">
<span class="overlay"></span>

<nav class="main">
    <div class="container">{{-- 顶部条 --}}@yield('header-bar')</div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">@yield('side-container')</div>
        <div class="col-md-offset-1 col-md-9" style="padding-top: 10px">@yield('body-container')</div>
    </div>

</div>

<footer class="main">@yield('footer-bar')</footer>


</body>
</html>