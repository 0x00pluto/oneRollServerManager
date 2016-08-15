@extends('layouts.mastertemplate') @section('title','登录')
@section('body-container')
<!-- resources/views/auth/login.blade.php -->
<div>
	<form method="POST" action="/auth/login">
		{!! csrf_field() !!}

		<div>
			Email <input type="email" name="email" value="{{ old('email') }}">
		</div>

		<div>
			Password <input type="password" name="password" id="password">
		</div>

		<div>
			<input type="checkbox" name="remember"> Remember Me
		</div>

		<div>
			<button type="submit">Login</button>
		</div>
		<div>
			<a href="/auth/register">注册</a>
		</div>
	</form>
</div>
@endsection
