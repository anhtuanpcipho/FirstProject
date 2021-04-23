@section('scripts_delete_work')
@parent
<script type="text/javascript">
$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
});

$(function(){
    // $.noConflict();
    var currentId;
    $("button.delete-work-class").click(function(){
        currentId = $(this).attr("data-target").slice(7);
        console.log(currentId);
        $('#deleteForm'+currentId).submit(function(e){
            // alert('Waiting for processing your data...');
            e.preventDefault();
            $.ajax({
                method:"POST",
                headers:{
                    Accept:"application/json"
                },
                url:"{{ route('liveDelete') }}",
                data:new FormData(this),
                //data : $(this).serialize(),
                processData:false,
                contentType:false,
                dataType:'json',
                success:function(data){
                    $('#delete'+currentId).modal('hide');
                    alert('Deleted work successfully!');
                    console.log($("tr.tr"+data.id).val());
                    $("tr.tr"+data.id).hide()    
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('PUT error.');
                }
            });
        });
    });
});
</script>
@endsection