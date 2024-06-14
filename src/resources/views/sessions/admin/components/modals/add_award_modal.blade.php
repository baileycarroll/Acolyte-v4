<div class="modal fade" id="addAwardModal" tabindex="-1" aria-labelledby="addAwardModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/create_award" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <h4 class="text-center text-primary">Create Award</h4>
                    <label for="#award-name">Award Name:</label>
                    <input type="text" name="name" id="award-name" class="form-control" required>

                    <label for="#award-description">Description:</label>
                    <input type="text" class="form-control" id="award-description" name="description" required>

                    <div class="file-upload-wrapper">
                        <label for="award-upload-file">Upload Image:</label>
                        <input
                            type="file"
                            id="award-upload-file"
                            name="award-upload-file"
                            class="file-upload-input"
                            data-mdb-file-upload="file-upload"
                            data-mdb-accepted-extensions=".png,.jpg,.jpeg,.svg,.wepb"
                            required
                        >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-mdb-dismiss="modal">Close w/Out Saving</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
