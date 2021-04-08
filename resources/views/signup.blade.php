@extends('layout')

@section('content')

<h1>LARAVEL CRUD</h1>
<h2>Login</h2>

<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>

<div>
  <a href="{{ route('works.index')}}" class="btn btn-primary btn-sm"">Back</a>
</div>

<div class="card push-top">
  <div class="card-header">
    Create your acocunt!!!
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
      <form method="post" action="{{ route('postSignup') }}">
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
@endsection