<div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/create_permission" method="post">
                @csrf
                <div class="modal-body">
                    <h4 class="text-center text-primary">Create Permission</h4>
                    <label for="#award-name">Permission Name:</label>
                    <input type="text" name="permission_name" id="permission_name" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-mdb-dismiss="modal">Close w/Out Saving</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
