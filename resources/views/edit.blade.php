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

<div>
  <a href="{{ route('works.index')}}" class="btn btn-primary btn-sm"">Back</a>
</div>

<div class="card push-top">
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
      <form method="post" action="{{ route('works.update', $work->id) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="title">Title</label>
              <input type="text" class="form-control" name="title" value="{{ $work->title }}"/>
          </div>
          <div class="form-group">
              <label for="creator">Creator</label>
              <input type="text" class="form-control" name="creator" value="{{ $work->creator }}"/>
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