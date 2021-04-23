@section('scripts_edit_work')
@parent

<script type="text/javascript">
$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
});

$(function(){
    // $.noConflict();

    $('form.editForm').submit(function(e){
        e.preventDefault();
        currentId = $(this).children('div.form-group input.form-control').first().attr('value');
        $.ajax({
            method:"POST",
            headers:{
                Accept:"application/json"
            },
            url:"{{ route('liveEdit') }}",
            data:new FormData(this),
            processData:false,
            contentType:false,
            dataType:'json',
            beforeSend:function(){
                $("#editForm"+currentId).find('div.form-group').find('span.error-text').text('');
            },
            success:function(data){
                console.log(data);
                if(data.status == 0){
                    $.each(data.error, function(prefix, val){
                        console.log(val);
                        $('span.'+val[4]+val[5]+'_error').text(val);
                        console.log('Unvalidate message!');
                    });
                } else {
                    $('#edit'+data.id).modal('hide');
                    alert('Updated a new work successfully!');

                    console.log(data.id);
                    var imgref = "/storage/"+data.image
                    $("tr.tr"+data.id+" td.image-class").html('<img src="/storage/'+data.image+'" style="width:60px;height:60px;">');
                    $("tr.tr"+data.id+" td.title-class").text(data.title);
                    $("tr.tr"+data.id+" td.collaborator-class").text(data.collaborator);
                    $("tr.tr"+data.id+" td.deadline-class").text(data.deadline);
                    $("tr.tr"+data.id+" td.workdone-class").text(data.workdone);
                    $("tr.tr"+data.id+" td.note-class").text(data.note);
                    $("tr.tr"+data.id+" td.text-class button").last().attr("data-target", "#delete"+data.id);  
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                alert('You may have not signed in or not have author to perform this action!!! Contact to the Admin to resolve this problem. Thanks!!!')
                console.log('PUT error.');
            }
        });
    });
});
</script>
@endsection