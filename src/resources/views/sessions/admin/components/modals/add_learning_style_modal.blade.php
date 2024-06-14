<div class="modal fade" id="addLearningStyleModal" tabindex="-1" aria-labelledby="addLearningStyleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/add_learning_style" method="post">
                @csrf
                <div class="modal-body">
                    <h4 class="text-center text-primary">Add Learning Style</h4>
                    <label for="#add_category_name">Learning Style Name:</label>
                    <input type="text" name="learning_style_name" id="add_learning_style_name" class="form-control">

                    <label for="#add_learning_style_description">Description:</label>
                    <input type="text" class="form-control" id="add_learning_style_description" name="learning_style_description">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-mdb-dismiss="modal">Close w/Out Saving</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
