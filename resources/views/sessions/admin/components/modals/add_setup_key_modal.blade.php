<div class="modal fade" id="addSetupKeyModal" tabindex="-1" aria-labelledby="addSetupKeyModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/add_setup_key" method="post">
                @csrf
                <div class="modal-body">
                    <h4 class="text-center text-primary">Add Key</h4>
                    <label for="#key_name">Key:</label>
                    <input type="text" name="key_name" id="key_name" class="form-control" required>
                    <label for="#key_value">Value:</label>
                    <input type="text" name="key_value" id="key_value" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-mdb-dismiss="modal">Close w/Out Saving</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
