@extends('layouts.mastertemplate')
@section('side-container')
    <section class="sidebar">@yield('body-sidebar')</section>
@endsection
@section('body-container')


    <div id="body-content">@yield('body-content')</div>
@endsection

