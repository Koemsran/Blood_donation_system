@extends('layouts.base')

@section('content')
<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background-color: #f5f5f5; padding: 20px;">
    @yield('auth_content')
</div>
@endsection