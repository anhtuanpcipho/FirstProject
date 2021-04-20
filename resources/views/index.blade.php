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

<!-- <div style="margin:10px;text-align:right;">
<form action="{{ route('search')}}" method="get">
  @csrf
  <input type="text" name="search" maxlength="100" style="width:60%" placeholder="Search any thing in our website..." required/>
  <button type="submit">Search</button>
</form>
</div> -->


<!-- <div style="margin-bottom:10px">
  <a href="{{ route('works.create')}}" class="btn btn-primary btn-sm"">Add Work</a>
</div>

<div>
  <a href="http://localhost:8000/livesearch" class="btn btn-primary btn-sm"">Go to Live Search</a>
</div> -->
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
            <td><b>Collaborator</b></td>
            <td><b>Created Date</b></td>
            <td><b>Deadline</b></td>
            <td><b>Workdone</b></td>
            <td><b>Note</b></td>
            <td class="text-center"><b>Action</b></td>
          </tr>
      </thead>
      <tbody>
          @foreach($work as $works)
          <tr class="tr-clone">
              <td class="id-class">{{$works->id}}</td>
              <td class="image-class"><img src="{{ Storage::drive('storage')->url($works->image) }}" style="width:60px;height:60px;"></td>
              <td class="title-class">{{$works->title}}</td>
              <td class="collaborator-class">{{$works->collaborator}}</td>
              <td class="created_at-class">{{$works->created_at}}</td>
              <td class="deadline-class">{{$works->deadline}}</td>
              <td class="workdone-class">{{$works->workdone}}</td>
              <td class="note-class">{{$works->note}}</td>
              <td class="text-center text-class">
                  <!-- <p style="display:hide">{{$interval = $works->id}}</p> -->
                  <a href="{{ route('works.edit', $works->id)}}" class="btn btn-primary btn-sm">Edit</a>
                  <form action="{{ route('works.destroy', $works->id)}}" method="post" style="display: inline-block">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm" type="submit"><b>Delete</b></button>
                  </form>
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>
  </div>
</div>


@endsection