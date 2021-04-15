@extends('layout')

@section('content')



<style>
    .container {
      max-width: 650px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>


<div class="container">
<h1>LARAVEL CRUD</h1>
<h2>Signup</h2>
</div>

<div class="container card push-top">
  <div class="card-header">
    Create your account!!!
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

          <div class="form-group">
              <label for="role">You are: </label>
              <select id="role" class="form-control" name="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
              </select>
          </div>

          <button type="submit" class="btn btn-block btn-danger">Submit</button>
      </form>
  </div>
</div>
@endsection