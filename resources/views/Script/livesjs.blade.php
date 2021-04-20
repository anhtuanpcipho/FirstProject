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
                    
                    for (let i = 0; i < data.length; i++){
                        console.log(data[i])
                        searchResultAjax += '<tr>'
                        searchResultAjax += '<td>'+data[i].id+'</td>'
                        searchResultAjax +='<td><img src="/storage/'+data[i].image+'" style="width:60px;height:60px;"></td>'
                        searchResultAjax +='<td>'+data[i].title+'</td>'
                        searchResultAjax +='<td>'+data[i].creator+'</td>'
                        searchResultAjax +='<td>'+data[i].created_at+'</td>'
                        searchResultAjax +='<td>'+data[i].deadline+'</td>'
                        searchResultAjax +='<td>'+data[i].workdone+'</td>'
                        searchResultAjax +='<td>'+data[i].note+'</td>'
                        searchResultAjax +='</tr>'
                    }
                  
                    $("#searchResult").html(searchResultAjax);
                }
            });
        }
    });

</script>

@endsection