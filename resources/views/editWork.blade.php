<!-- Modal to show live form to add works -->
<div class="modal fade" id="edit{{$currentId}}">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit your work directly</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">

            <!-- Throw errors if any field is ivalid -->
            <!-- <div class="alert alert-danger">
            
            </div><br /> -->

            <!-- Add information about your work -->
            <form method="post" action="{{ route('liveEdit') }}" class="editForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="id">ID: {{$currentId}}</label>
                    <input hidden type="text" class="form-control" name="id" value={{$currentId}} />
                </div>
                <div class="form-group">
                    @csrf
                    @method('POST')
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" value="{{ $title }}"/>
                    <span class="text-danger error-text ti_error"></span>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" src="storage/{{ $image }}"/>
                    <span class="text-danger error-text im_error"></span>
                </div>
                <div class="form-group">
                    <label for="collaborator">Collaborator</label>
                    <input type="text" class="form-control" name="collaborator" value="{{ $collaborator }}"/>
                    <span class="text-danger error-text co_error"></span>
                </div>
                <div class="form-group">
                    <label for="deadline">Deadline</label>
                    <input type="text" class="form-control" name="deadline" value="{{ $deadline }}"/>
                    <span class="text-danger error-text de_error"></span>
                </div>
                <div class="form-group">
                    <label for="workdone">Work done (%)</label>
                    <input type="number" class="form-control" name="workdone" value="{{ $workdone }}"/>
                    <span class="text-danger error-text wo_error"></span>
                </div>
                <div class="form-group">
                    <label for="workdone">Note (No Compulsory!)</label>
                    <input type="text" class="form-control" name="note" value="{{ $note }}"/>
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