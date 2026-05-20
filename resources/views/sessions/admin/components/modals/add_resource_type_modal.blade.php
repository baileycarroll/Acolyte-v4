<div class="modal fade" id="addResource_TypeModal" tabindex="-1" aria-labelledby="addResource_TypeModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/add_resource_type" method="post">
                @csrf
                <div class="modal-body">
                    <h4 class="text-center text-primary">Add Resource Type</h4>
                    <label for="#add_resource_type_name">Resource Type Name:</label>
                    <input type="text" name="resource_type_name" id="add_resource_type_name" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-mdb-dismiss="modal">Close w/Out Saving</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
