<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container pt-5">
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
                    for (let i = 0; i < data.length; i++){
                        searchResultAjax += '<div class="col-3 p-1">'
                        searchResultAjax +='<div class="p-3 bg-primary">'
                        searchResultAjax +='<p class="font-weight-bold text-white float-left">ID:</p>'
                        searchResultAjax +='<p class="font-weight-bold text-white float-right">'+data[i].id+'</p>'
                        searchResultAjax +='<div style="clear: both;"></div>'
                        searchResultAjax +='<p class="font-weight-bold text-white float-left">Creator:</p>'
                        searchResultAjax +='<p class="font-weight-bold text-white float-right">'+data[i].creator+'</p>'
                        searchResultAjax +='<div style="clear: both;"></div>'
                        searchResultAjax +='</div>'
                        searchResultAjax +='</div>'
                    }
                    $('#searchResult').html(searchResultAjax);
                }
            })
        }
    })
</script>