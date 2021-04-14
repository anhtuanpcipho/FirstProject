@extends('layout')

@section('content')

<style>
  .push-top {
    margin-top: 50px;
  }
</style>
<h1>LARAVEL CRUD</h1>

<div style="margin:10px;text-align:right;">
<form action="{{ route('search')}}" method="get">
  @csrf
  <input type="text" name="search" maxlength="100" style="width:60%" placeholder="Search any thing in our website..." required/>
  <button type="submit">Search</button>
</form>
</div>

<div style="margin-bottom:15px;">
  <a href="/works" class="btn btn-primary btn-sm">Home</a>
</div>

<div>
  <a href="{{ route('works.create')}}" class="btn btn-primary btn-sm">Add Work</a>
</div>
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
        @foreach($posts as $works)
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
@endsection