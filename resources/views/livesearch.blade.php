<!DOCTYPE html>
<html>
<head>
    <title>Anhtuan's livesearch</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
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
                <a href="#" class="nav-link" data-toggle="modal" data-target="#myModal">Live add works</a>
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
    @endif

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
</body>
</html>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#inputSearch').on('keyup' ,function(){
        $inputSearch = $(this).val();
        if($inputSearch ==''){
            $('#searchResult').html('');
            $('#searchResult').hide();
        }else{
            $.ajax({
                method:"post",
                url:'livesearch',
                data:JSON.stringify({
                    inputSearch:$inputSearch
                }),
                headers:{
                    'Accept':'application/json',
                    'Content-Type':'application/json'
                },
                success: function(data){
                    var searchResultAjax='';
                    data = JSON.parse(data);
                    console.log(data);
                    $('#searchResult').show();
                    searchResultAjax +='<table class="table">'
                    searchResultAjax +='<thead>'
                    searchResultAjax +='<tr class="table-warning">'
                    searchResultAjax +='<td><b>ID</b></td>'
                    searchResultAjax +='<td><b>Image</b></td>'
                    searchResultAjax +='<td><b>Title</b></td>'
                    searchResultAjax +='<td><b>Creator</b></td>'
                    searchResultAjax +='<td><b>Created Date</b></td>'
                    searchResultAjax +='<td><b>Deadline</b></td>'
                    searchResultAjax +='<td><b>Workdone</b></td>'
                    searchResultAjax +='</tr>'
                    searchResultAjax +='</thead>'
                    searchResultAjax +='<tbody>'
                    for (let i = 0; i < data.length; i++){
                        console.log(data[i])
                        searchResultAjax += '<tr>'
                        searchResultAjax += '<td>'+data[i].id+'</td>'
                        searchResultAjax +='<td><img src="http://localhost:8000/storage/'+data[i].image+'" style="width:60px;height:60px;"></td>'
                        searchResultAjax +='<td>'+data[i].title+'</td>'
                        searchResultAjax +='<td>'+data[i].creator+'</td>'
                        searchResultAjax +='<td>'+data[i].created_at+'</td>'
                        searchResultAjax +='<td>'+data[i].deadline+'</td>'
                        searchResultAjax +='<td>'+data[i].workdone+'</td>'
                        searchResultAjax +='</tr>'
                    }
                    searchResultAjax +='</tbody>'
                    searchResultAjax +='</table>'
                    $('#searchResult').html(searchResultAjax);
                }
            })
        }
    })
</script>