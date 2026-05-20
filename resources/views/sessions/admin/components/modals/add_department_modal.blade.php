<div class="modal fade" id="addDeptModal" tabindex="-1" aria-labelledby="addDeptModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/add_department" method="post">
                @csrf
                <div class="modal-body">
                    <h4 class="text-center text-primary">Add Department</h4>
                    <label for="#add_department_name">Department Name:</label>
                    <input type="text" name="department_name" id="add_department_name" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-mdb-dismiss="modal">Close w/Out Saving</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
