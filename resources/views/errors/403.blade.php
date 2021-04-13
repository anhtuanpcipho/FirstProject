@extends('layout')

@section('content')

<style>
  .push-top {
    margin-top: 50px;
  }
</style>
<h1>LARAVEL CRUD</h1>

<h1 style="text-align:center;color:red;">Whoops!!!</h1>
<p>This action is just done by administration!!!</p>

@if(session()->get('email')=="")
<div style="margin:10px;text-align:right;">
<a href="{{ route('logins')}}" class="btn btn-primary btn-sm"">Login</a>
<a href="{{ route('signup')}}" class="btn btn-primary btn-sm"" style="display: inline-block">Signup</a>
</div>
@endif

@if(!(session()->get('email')==""))
<div style="margin:10px;text-align:right;">
<p><strong>Welcome</strong> <i>{{ session()->get('email') }}</i></p>
<a href="{{ route('works.index') }}" class="btn btn-primary btn-sm"" style="display: inline-block">Back</a>
</div>
@endif

@endsection