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
    <div id="searchResult" class="row m-0 mt-4" style="display: none;">

    </div>
</div>

@include('Script.livesjs')
@yield('live_search_js')
@endsection