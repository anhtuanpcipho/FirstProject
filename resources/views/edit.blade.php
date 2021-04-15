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

<div class="container"><h1>LARAVEL CRUD</h1></div>

<div class="container card push-top">
  <div class="card-header">
    Edit & Update
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
      <form method="post" action="{{ route('works.update', $work->id) }}" enctype="multipart/form-data">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="title">Title</label>
              <input type="text" class="form-control" name="title" value="{{ $work->title }}"/>
          </div>
          <div class="form-group">
              <label for="image">Image</label>
              <input type="file" class="form-control" name="image" value="{{ $work->image }}"/>
          </div>
          <div class="form-group">
              <label for="collaborator">Collaborator</label>
              <input type="text" class="form-control" name="collaborator" value="default"/>
          </div>
          <div class="form-group">
              <label for="deadline">Deadline</label>
              <input type="text" class="form-control" name="deadline" value="{{ $work->deadline }}"/>
          </div>
          <div class="form-group">
              <label for="workdone">Work done (%)</label>
              <input type="number" class="form-control" name="workdone" value="{{ $work->workdone }}"/>
          </div>
          <button type="submit" class="btn btn-block btn-danger">Update Work</button>
      </form>
  </div>
</div>
@endsection