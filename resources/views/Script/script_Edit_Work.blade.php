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

    $('#editForm{{$currentId}}').submit(function(e){
        e.preventDefault();
        // alert('Hello')
        $.ajax({
            
            method:"POST",
            headers:{
                Accept:"application/json"
            },
            url:"{{ route('liveEdit') }}",
            data:new FormData(this),
            //data : $(this).serialize(),
            processData:false,
            contentType:false,
            dataType:'json',
            beforeSend:function(){
                $("form").find('span.error-text').text('');
            },
            success:function(data){
                if(data.status == 0){
                    $.each(data.error, function(prefix, val){
                        console.log(val);
                        $('span.'+val[4]+val[5]+'_error').text(val);
                        console.log('Unvalidate message!');
                    });
                } else {
                    
                    //$('#editForm{{$currentId}}')[0].reset();
                    $('#edit{{$currentId}}').modal('hide');
                    alert('Updated a new work successfully!');
                    // redirect('/works');
                    // $("tr.tr-clone").last().clone().removeClass("tr-clone").addClass("first-clone").prependTo("tbody");
                    // $("tbody")  
                    console.log(data.id);
                    var imgref = "/storage/"+data.image
                    $("tr.tr"+data.id+" td.image-class").html('<img src="/storage/'+data.image+'" style="width:60px;height:60px;">');
                    $("tr.tr"+data.id+" td.title-class").text(data.title);
                    $("tr.tr"+data.id+" td.collaborator-class").text(data.collaborator);
                    $("tr.tr"+data.id+" td.deadline-class").text(data.deadline);
                    $("tr.tr"+data.id+" td.workdone-class").text(data.workdone);
                    $("tr.tr"+data.id+" td.note-class").text(data.note);
                    $("tr.tr"+data.id+" td.text-class button").last().attr("data-target", "#delete"+data.id);

                    // $("tr.first-clone td.text-class").first().text(data.note);
                }
                
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log('PUT error.');
            }

        });

    });
});
</script>
@endsection