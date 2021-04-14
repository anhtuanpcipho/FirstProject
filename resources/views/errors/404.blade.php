@extends('layout')

@section('content')

<style>
  .push-top {
    margin-top: 50px;
  }
</style>
<h1>LARAVEL CRUD</h1>

<div>
  <a href="{{ route('works.index')}}" class="btn btn-primary btn-sm">Home Page</a>
</div>

<h1 style="text-align:center;color:red;">Whoops!!!</h1>
<p>You must log-in to implement this action!!!</p>


<div style="margin:10px;text-align:right;">
<a href="{{ route('logins')}}" class="btn btn-primary btn-sm">Login</a>
<a href="{{ route('signup')}}" class="btn btn-primary btn-sm" style="display: inline-block">Signup</a>
</div>

@endsection