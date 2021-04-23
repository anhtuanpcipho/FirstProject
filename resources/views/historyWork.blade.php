@extends('layout')

@section('content')

<style>
  .push-top {
    margin-top: 50px;
  }
</style>

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
            <td><b>Image</b></td>
            <td><b>Title</b></td>
            <td><b>Collaborator</b></td>
            <td><b>Created/Updated Date</b></td>
            <td><b>Deadline</b></td>
            <td><b>Workdone</b></td>
            <td><b>Note</b></td>
            <td class="text-center"><b>Action</b></td>
          </tr>
      </thead>
      <tbody>
          @include('Script.js_deleteWork')
          @include('Script.script_Edit_Work')
          @foreach($work as $works)
          <tr class="tr-clone tr{{$works->id}}">
              <td class="image-class"><img src="{{ Storage::drive('storage')->url($works->image) }}" style="width:60px;height:60px;"></td>
              <td class="title-class">{{$works->title}}</td>
              <td class="collaborator-class">{{$works->collaborator}}</td>
              <td class="created_at-class">{{$works->created_at}}</td>
              <td class="deadline-class">{{$works->deadline}}</td>
              <td class="workdone-class">{{$works->workdone}}</td>
              <td class="note-class">{{$works->note}}</td>
              <td class="text-center text-class">
                  <!-- <p style="display:hide">{{$interval = $works->id}}</p> -->
                  <button class="btn btn-primary btn-sm edit-work-class" data-toggle="modal" data-target="#edit{{$works->id}}">Edit</button>
                  <!-- <form action="{{ route('works.destroy', $works->id)}}" method="post" style="display: inline-block">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                  </form> -->
                  <button class="btn btn-danger btn-sm delete-work-class" data-toggle="modal" data-target="#delete{{$works->id}}">Delete</button>
              </td>
          </tr>
          @include('editWork', [
          'currentId' => $works->id,
          'title' => $works->title,
          'image' => $works->image,
          'collaborator' => $works->collaborator,
          'deadline' => $works->deadline,
          'workdone' => $works->workdone,
          'note' => $works->note,
          ])
          @include('deleteWork', ['currentId' => $works->id])
          @endforeach

          
      </tbody>
    </table>
  </div>
</div>


@endsection