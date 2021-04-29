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
    $('form.deleteForm').submit(function(e){
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
                $('#delete'+data.id).modal('hide');
                alert('Deleted work successfully!');
                console.log($("tr.tr"+data.id).val());
                $("tr.tr"+data.id).hide()    
            },
            error: function (xhr, textStatus, errorThrown) {
                alert('You may have not signed in or not have author to perform this action!!! If you have any question, please contact to the Admin! Thanks!')
                console.log('PUT error.');
            }
        });
    });
});
</script>
@endsection