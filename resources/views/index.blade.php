@extends('layout')

@section('content')

<style>
  .push-top {
    margin-top: 50px;
  }
</style>
<div>
  <a href="{{ route('works.create')}}" class="btn btn-primary btn-sm"">Add Work</a>
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
          <td>ID</td>
          <td>Title</td>
          <td>Creator</td>
          <td>Created Date</td>
          <td>Deadline</td>
          <td>Workdone</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($work as $works)
        <tr>
            <td>{{$works->id}}</td>
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
                    <button class="btn btn-danger btn-sm"" type="submit">Delete</button>
                  </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection