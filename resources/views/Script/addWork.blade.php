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
                    resdata = data;
                    
                    //$('#registerForm')[0].reset();
                    $('#myModal').modal('hide');
                    alert('Added a new work successfully!');
                    //redirect('/works');
                    $("tr.tr-clone").last().clone().removeClass("tr-clone").addClass("first-clone").prependTo("tbody");
                    //$("tbody")
                    
                }
                console.log(resdata);
                $("tr.first-clone td.id-class").first().text(data.id);
                var imgref = "/storage/"+data.image
                $("tr.first-clone td.image-class").first().html('<img src="/storage/'+data.image+'" style="width:60px;height:60px;">');
                $("tr.first-clone td.title-class").first().text(data.title_at);
                $("tr.first-clone td.collaborator-class").first().text(data.collaborator);
                var timecreate = data.created_at.slice(0,10)+' '+data.created_at.slice(11,19);
                $("tr.first-clone td.created_at-class").first().text(timecreate);
                $("tr.first-clone td.deadline-class").first().text(data.deadline);
                $("tr.first-clone td.workdone-class").first().text(data.workdone);
                $("tr.first-clone td.note-class").first().text(data.note);
                // $("tr.first-clone td.text-class").first().text(data.note);
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log('PUT error.');
            }

        });

    });
});

// function after_add(resdata){
//     console.log($("tr.tr-clone td.id-class").first().val());
//     $("tr.tr-clone td.id-class").first().text(resdata.id);
//     //$("td.image-class").last().html(data.created_at);
//     $("tr.tr-clone td.title-class").first().text(resdata.title_at);
//     $("tr.tr-clone td.collaborator-class").first().text(resdata.collaborator);
//     $("tr.tr-clone td.created_at-class").first().text(resdata.created_at);
//     $("tr.tr-clone td.deadline-class").first().text(resdata.deadline);
//     $("tr.tr-clone td.workdone-class").first().text(resdata.workdone);
//     $("tr.tr-clone td.note-class").first().text(resdata.note);
// };
</script>

@endsection