
<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.master') @section('title', 'Page Title')
{{-- This comment will not be present in the rendered HTML --}}
@section('sidebar') @@parent

<p>This is appended to the master sidebar.</p>
@endsection @section('content')
<p>This is my body content. Hello , @{{ $name }} . {{ time () }}.</p>
<p>name: {{ isset($name)? $name : 'Default' }}</p>
@endsection
