<!-- Modal to show live form to add works -->
<div class="modal fade modal-delete-work" id="delete{{$currentId}}">
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
            <p><b>Notice: </b>Do you want to delete this work? <p class="reedit-id">(ID: {{$currentId}})</p></p>

            <!-- <button id = "btn1" class="btn btn-primary btn-sm" style="text-align:right;">Add another work!!</button> -->
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <form method="post" class="delete-work-id deleteForm" action="{{ route('liveDelete') }}" enctype="multipart/form-data">
                    <input hidden type="text" class="form-control confirm-delete" name="id" value={{$currentId}} />
                    <button type="submit" class="btn btn-danger" >Yes, Delete permenantly!</button>
                </form> 
                <button type="button" class="btn btn-danger" data-dismiss="modal" style="display: inline-block">Close</button>
            </div>
        
        </div>
    </div>
</div>