@section('live_search_js')
@parent

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
                    searchResultAjax +='<td><b>Collaborator</b></td>'
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

@endsection