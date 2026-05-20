<div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/create_role" method="post">
                @csrf
                <div class="modal-body">
                    <h4 class="text-center text-primary">Create Role</h4>
                    <label for="#award-name">Role Name:</label>
                    <input type="text" name="role_name" id="role_name" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-mdb-dismiss="modal">Close w/Out Saving</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
