@extends('layout')
@section('content')
<div class="container pt-5">
    <h1>LARAVEL CRUD</h1>
    <div class="row m-0">
        <div class="col-4 p-0">
            <label class="font-weight-bold">Search Input</label>
            <input id="inputSearch" type="" class="form-control" name="">
        </div>
    </div>
    <div class="row m-0 mt-4">
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
            </tr>
            </thead>
            <tbody id="searchResult" style="display: none;">
            <!-- Content goes here!!!! -->
            </tbody>
        </table>
    </div>
</div>

@include('Script.livesjs')
@yield('live_search_js')
@endsection