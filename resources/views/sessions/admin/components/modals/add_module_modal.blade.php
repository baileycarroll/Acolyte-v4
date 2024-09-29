<div class="modal fade" id="addModuleModal" tabindex="-1" aria-labelledby="addModuleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="/create_module" method="post">
                @csrf
                <input type="hidden" name="course" value="{{$course->id}}">
                <div class="modal-body">
                    <h4 class="text-center text-primary">Create Module</h4>
                    <div class="row g-3">
                        <div class="col">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                    </div>

                    <label for="description">Description:</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control mb-3"></textarea>

                    <div class="form-outline datepicker" data-mdb-format="yyyy-mm-dd">
                        <input type="text" name="available_on" id="available_on" class="form-control">
                        <label for="available_in" class="form-label">Available On:</label>
                    </div>
                    <div class="form-outline datepicker mt-3" data-mdb-format="yyyy-mm-dd">
                        <input type="text" name="not_available" id="unavailable_on" class="form-control">
                        <label for="unavailable_in" class="form-label">Unavailable On:</label>
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
