@extends('layout')

@section('content')

<style>
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
</nav>



@if(session()->get('email')=="")
<div style="margin:10px;text-align:right;">
<a href="{{ route('logins')}}" class="btn btn-primary btn-sm"">Login</a>
<a href="{{ route('signup')}}" class="btn btn-primary btn-sm"" style="display: inline-block">Signup</a>
</div>
@endif

@if(!(session()->get('email')==""))
<div style="margin:10px;text-align:right;">
<p><strong>Welcome</strong> <i>{{ session()->get('email') }}</i></p>
<a href="{{ route('logout') }}" class="btn btn-primary btn-sm"" style="display: inline-block">Logout</a>
</div>
@endif -->


<div class="container-xl">
  <h1>LARAVEL CRUD</h1>
  <div class="push-top">
    @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}  
      </div><br />
    @endif
    <table class="table">
      <thead>
          <tr class="table-warning">
            <td><b>ID</b></td>
            <td><b>Image</b></td>
            <td><b>Title</b></td>
            <td><b>Creator</b></td>
            <td><b>Created Date</b></td>
            <td><b>Deadline</b></td>
            <td><b>Workdone</b></td>
            <td class="text-center"><b>Action</b></td>
          </tr>
      </thead>
      <tbody>
          @foreach($work as $works)
          <tr>
              <td>{{$works->id}}</td>
              <td><img src="{{ Storage::drive('storage')->url($works->image) }}" style="width:60px;height:60px;"></td>
              <td>{{$works->title}}</td>
              <td>{{$works->creator}}</td>
              <td>{{$works->created_at}}</td>
              <td>{{$works->deadline}}</td>
              <td>{{$works->workdone}}</td>
              <td class="text-center">
                  <a href="{{ route('works.edit', $works->id)}}" class="btn btn-primary btn-sm"">Edit</a>
                  <form action="{{ route('works.destroy', $works->id)}}" method="post" style="display: inline-block">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm"" type="submit"><b>Delete</b></button>
                    </form>
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>
  <div>
</div>

@endsection