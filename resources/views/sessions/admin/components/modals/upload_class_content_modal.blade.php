<div class="modal fade" id="uploadClassContentModal" tabindex="-1" aria-labelledby="uploadClassContentModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="/upload_class_content" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div id="dnd-accept-formats" class="file-upload-wrapper">
                        <input type="hidden" name="class_name" value="{{str_replace(" ", "_", $class->name)}}">
                        <input type="hidden" name="class_id" value="{{$class->id}}">
                        <input
                            type="file"
                            name="class_content"
                            class="file-upload-input"
                            data-mdb-file-upload="file-upload"
                        />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-mdb-dismiss="modal">Close w/Out Saving</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
