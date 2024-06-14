<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/add_category" method="post">
                @csrf
                <div class="modal-body">
                    <h4 class="text-center text-primary">Add Category</h4>
                    <label for="#add_category_name">Category Name:</label>
                    <input type="text" name="category_name" id="add_category_name" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-mdb-dismiss="modal">Close w/Out Saving</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
