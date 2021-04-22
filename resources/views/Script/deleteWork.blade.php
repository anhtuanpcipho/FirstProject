<!-- Modal to show live form to add works -->
<div class="modal fade" id="delete{{$currentId}}">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Delete Work</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">

            <!-- Throw errors if any field is ivalid -->
            <!-- <div class="alert alert-danger">
            
            </div><br /> -->

            <!-- Add information about your work -->
            <p><b>Notice: </b>Do you want to delete this work?</p>

            <!-- <button id = "btn1" class="btn btn-primary btn-sm" style="text-align:right;">Add another work!!</button> -->
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <form method="post" action="{{ route('liveDelete') }}" id="deleteForm{{$currentId}}" enctype="multipart/form-data">
                    <input hidden type="text" class="form-control" name="id" value={{$currentId}} />
                    <button type="submit" class="btn btn-danger">Yes, Delete permenantly!</button>
                </form>
                <button type="button" class="btn btn-danger" data-dismiss="modal" style="display: inline-block">Close</button>
            </div>
        
        </div>
    </div>
</div>


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

    $('#deleteForm{{$currentId}}').submit(function(e){
        e.preventDefault();
        // alert('Hello')
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
                if(data.status == 0){
                    $.each(data.error, function(prefix, val){
                        console.log(val);
                        $('span.'+val[4]+val[5]+'_error').text(val);
                        console.log('Unvalidate message!');
                    });
                } else {
                    
                    //$('#editForm{{$currentId}}')[0].reset();
                    $('#delete{{$currentId}}').modal('hide');
                    alert('Deleted work successfully!');
                    // redirect('/works');
                    // $("tr.tr-clone").last().clone().removeClass("tr-clone").addClass("first-clone").prependTo("tbody");
                    // $("tbody")  
                    // console.log(data.id);
                    // var imgref = "/storage/"+data.image
                    console.log($("tr.tr"+data.id).val());
                    $("tr.tr"+data.id).hide()
                    // $("tr.tr"+data.id).text(data.title);
                    // $("tr.tr"+data.id).text(data.collaborator);
                    // $("tr.tr"+data.id).text(data.deadline);
                    // $("tr.tr"+data.id).text(data.workdone);
                    // $("tr.tr"+data.id).text(data.note);
                    // $("tr.tr"+data.id+" td.text-class button").text(data.note);

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