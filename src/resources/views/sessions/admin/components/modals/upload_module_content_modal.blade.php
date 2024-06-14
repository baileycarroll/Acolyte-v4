<div class="modal fade" id="uploadModuleContentModal" tabindex="-1" aria-labelledby="uploadModuleContentModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" id="content_form_body">
            <form action="/upload_module_content" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div id="dnd-accept-formats" class="file-upload-wrapper" id="upload-input">
                        <input type="hidden" name="module_name" value="{{str_replace(" ", "_", $module->name)}}">
                        <input type="hidden" name="module_id" value="{{$module->id}}">
                        <input
                            type="file"
                            name="module_content"
                            class="file-upload-input"
                            data-mdb-file-upload="file-upload"
                            data-mdb-acceptedExtensions=".mp4"

                        />
                    </div>
                    <div id="spinner"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-mdb-dismiss="modal">Close w/Out Saving</button>
                    <button type="submit" class="btn btn-primary" id="content_submit">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
