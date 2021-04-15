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
<div class=" container card push-top">
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
    <form method="post" action="{{ route('works.store') }}" enctype="multipart/form-data">
        <div class="card-header">
          Work 1
        </div>
        <div class="form-group">
            @csrf
            <label for="title[]">Title</label>
            <input type="text" class="form-control" name="title[]" placeholder="describe your task"/>
        </div>
        <div class="form-group">
            <label for="image[]">Upload your image</label>
            <input type="file" class="form-control" name="image[]"/>
        </div>
        <div class="form-group">
            <label for="collaborator[]">Collaborator</label>
            <input type="text" class="form-control" name="collaborator[]" value="default"/>
        </div>
        <div class="form-group">
            <label for="deadline[]">Deadline</label>
            <input type="text" class="form-control" name="deadline[]" placeholder="dd-mm-yyyy"/>
        </div>
        <div class="form-group">
            <label for="workdone[]">Work done (%)</label>
            <input type="number" class="form-control" name="workdone[]" placeholder="amount of work done"/>
        </div>
        <div id = "appendf">

        </div>
        <button type="submit" class="btn btn-block btn-danger">Submit</button>
      </form>

      <button id = "btn1" class="btn btn-primary btn-sm" style="text-align:right;">Add another work!!</button>

  </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  var i = 1;
  $(document).ready(function(){
    $("#btn1").click(function(){
        i += 1;
        var demo = `
        <hr style="width:100%;text-align:left;margin-left:0">
        <hr style="width:100%;text-align:left;margin-left:0">
        <div class="card-header">
          Work `+i+`
        </div>
        <div class="form-group">
            @csrf
            <label for="title[]">Title</label>
            <input type="text" class="form-control" name="title[]" placeholder="describe your task"/>
        </div>
        <div class="form-group">
            <label for="image[]">Upload your image</label>
            <input type="file" class="form-control" name="image[]"/>
        </div>
        <div class="form-group">
            <label for="creator[]">Creator</label>
            <input type="text" class="form-control" name="creator[]" placeholder="enter your full name"/>
        </div>
        <div class="form-group">
            <label for="deadline[]">Deadline</label>
            <input type="text" class="form-control" name="deadline[]" placeholder="dd-mm-yyyy"/>
        </div>
        <div class="form-group">
            <label for="workdone[]">Work done (%)</label>
            <input type="number" class="form-control" name="workdone[]" placeholder="amount of work done"/>
        </div>`;
        $("#appendf").append(demo);
    });
  });
</script>