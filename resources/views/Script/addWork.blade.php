<!-- Modal to show live form to add works -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add your work directly</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">

            <!-- Throw errors if any field is ivalid -->
            <!-- <div class="alert alert-danger">
            
            </div><br /> -->

            <!-- Add information about your work -->
            <form method="post" action="{{ route('liveStore') }}" id="registerForm" enctype="multipart/form-data">
                <div class="card-header">
                    Work 1
                </div>
                <div class="form-group">
                    @csrf
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="describe your task"/>
                    <span class="text-danger error-text ti_error"></span>
                </div>
                <div class="form-group">
                    <label for="image">Upload your image</label>
                    <input type="file" class="form-control" name="image"/>
                    <span class="text-danger error-text im_error"></span>
                </div>
                <div class="form-group">
                    <label for="collaborator">Collaborator</label>
                    <input type="text" class="form-control" name="collaborator" value="default"/>
                    <span class="text-danger error-text co_error"></span>
                </div>
                <div class="form-group">
                    <label for="deadline">Deadline</label>
                    <input type="text" class="form-control" name="deadline" placeholder="dd-mm-yyyy"/>
                    <span class="text-danger error-text de_error"></span>
                </div>
                <div class="form-group">
                    <label for="workdone">Work done (%)</label>
                    <input type="number" class="form-control" name="workdone" placeholder="amount of work done"/>
                    <span class="text-danger error-text wo_error"></span>
                </div>
                <div class="form-group">
                    <label for="workdone">Note (No Compulsory)</label>
                    <input type="text" class="form-control" name="note" placeholder="Note goes here..."/>
                </div>
            <button type="submit" class="btn btn-block btn-danger">Submit</button>
            </form>

            <!-- <button id = "btn1" class="btn btn-primary btn-sm" style="text-align:right;">Add another work!!</button> -->
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        
        </div>
    </div>
</div>

@section('scripts')
@parent

<script type="text/javascript">
$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
});

$(function(){
    $.noConflict();
    $('#registerForm').submit(function(e){
        e.preventDefault();
        // alert('Hello')
        $.ajax({
            method:"POST",
            headers:{
                Accept:"application/json"
            },
            url:"{{ route('liveStore') }}",
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
                    $('#myModal').modal('hide');
                    alert('Added a new work successfully!');
                    // Add a new line for work table
                    var appendhtml = $("tr.tr-clone").last().clone();
                    var imgref = "/storage/"+data.image
                    appendhtml.children("td.id-class").text(data.id);
                    appendhtml.children("td.image-class").html('<img src="/storage/'+data.image+'" style="width:60px;height:60px;">');
                    appendhtml.children("td.title-class").text(data.title);
                    appendhtml.children("td.collaborator-class").text(data.collaborator);
                    appendhtml.children("td.created_at-class").text(data.created_at);
                    appendhtml.children("td.deadline-class").text(data.deadline);
                    appendhtml.children("td.workdone-class").text(data.workdone);
                    appendhtml.children("td.note-class").text(data.note);
                    appendhtml.children("td.text-class").children("button.edit-work-class").attr("data-target","#edit"+data.id);
                    appendhtml.children("td.text-class").children("button.delete-work-class").attr("data-target","#delete"+data.id);
                    $(appendhtml).prependTo("tbody");
                    console.log(data);
                    // Add a new modal for work's just updated
                    var updateAddModal = $("div.modal-edit-work").last().clone();
                    updateAddModal.attr("id","edit"+data.id);
                    updateAddModal.find("label.id-edit-work").text("ID: "+data.id);
                    updateAddModal.find("input.id-edit").attr("value",data.id);
                    updateAddModal.find("input.title-edit-work").attr("value", data.title);
                    updateAddModal.find("input.image-edit-work").attr("src","storage/"+data.image);
                    updateAddModal.find("input.collaborator-edit-work").attr("value",data.collaborator);
                    updateAddModal.find("input.deadline-edit-work").attr("value",data.deadline);
                    updateAddModal.find("input.workdone-edit-work").attr("value",data.workdone);
                    updateAddModal.find("input.note-edit-work").attr("value",data.note);
                    $(updateAddModal).appendTo("tbody");
                    // Add a new modal for deleting work's just updated
                    var deleteAddModal = $("div.modal-delete-work").last().clone();
                    deleteAddModal.attr("id","delete"+data.id);
                    deleteAddModal.find("form.delete-work-id").attr("id","deleteForm"+data.id);
                    deleteAddModal.find("input.confirm-delete").attr("value",data.id);
                    deleteAddModal.find("p.reedit-id").html('<p>(ID: '+data.id+')</p>')
                    $(deleteAddModal).appendTo("tbody");
                }
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