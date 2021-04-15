@extends('layout')

@section('content')

<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>

<!-- <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="{{ route('works.index')}}">Home</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="{{ route('works.create')}}">Add Work</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="{{ route('livesearch') }}">Go to Live Search</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#" data-toggle="modal" data-target="#myModal">Live add works</a>
    </li>
    <li style="nav-item active">
      <form class="form-inline my-2 my-lg-0" action="{{ route('search')}}" method="get">
        @csrf
        <input class="form-control" type="text" name="search" maxlength="100" style="width:60%" placeholder="Search any thing..." required/>
        <button class="btn btn-success" type="submit">Search</button>
      </form>
    </li>
  </ul>
</nav> -->

<div class="container">
  <h1>LARAVEL CRUD</h1>
  <h2>Login</h2>

  <div class="card push-top">
    <div class="card-header">
      Welcome to our website!
    </div>

    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div><br />
      @endif
        <form method="post" action="{{ route('postLogin') }}">
            <div class="form-group">
                @csrf
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="example@anhtuan.com"/>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Input Password"/>
            </div>
            
            <button type="submit" class="btn btn-block btn-danger">Submit</button>
        </form>
    </div>
  </div>
</div>

@endsection