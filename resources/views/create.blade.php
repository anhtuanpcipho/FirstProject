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
    Add User
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
      <form method="post" action="{{ route('works.store') }}">
          <div class="form-group">
              @csrf
              <label for="title">Title</label>
              <input type="text" class="form-control" name="title"/>
          </div>
          <div class="form-group">
              <label for="creator">Creator</label>
              <input type="text" class="form-control" name="creator"/>
          </div>
          <div class="form-group">
              <label for="deadline">Deadline</label>
              <input type="text" class="form-control" name="deadline"/>
          </div>
          <div class="form-group">
              <label for="workdone">Work done (%)</label>
              <input type="number" class="form-control" name="workdone"/>
          </div>
          <button type="submit" class="btn btn-block btn-danger">Submit</button>
      </form>
  </div>
</div>
@endsection