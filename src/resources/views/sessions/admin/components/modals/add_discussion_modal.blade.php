<div class="modal fade" id="addDiscussionModal" tabindex="-1" aria-labelledby="addDiscussionModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="/add_discussion" method="post">
                @csrf
                <div class="modal-body">
                    <h4 class="text-center text-primary">Create Discussion</h4>
                    <div class="row g-3">
                        <div class="col">
                            <label for="topic">Topic:</label>
                            <input type="text" name="topic" id="topic" class="form-control" required>
                        </div>
                    </div>
                    <label for="information">Information:</label>
                    <textarea name="information" id="information" cols="30" rows="10" class="form-control" required></textarea>
                    <div class="row g-3">
                        <div class="col">
                            <label for="related_class_1">Related Class</label>
                            <select name="related_class_1" id="related_class_1" class="select" data-mdb-filter="true" data-mdb-container="#addDiscussionModal" aria-label="select-related_class_1" required>
                                <option selected>Choose Class</option>
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col">
                            <label for="related_module">Related Module</label>
                            <select name="related_module" id="related_module" class="select" data-mdb-filter="true" data-mdb-container="#addDiscussionModal" aria-label="select-related_module" required>
                                <option selected>Choose Module</option>
                                @foreach($modules as $module)
                                    <option value="{{$module->id}}">{{$module->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="month">Month Available</label>
                            <select name="month" id="month" class="select" aria-label="select-month" required>
                                <option selected>Choose Month for Discussion</option>
                                <option value="0">January</option>
                                <option value="1">February</option>
                                <option value="2">March</option>
                                <option value="3">April</option>
                                <option value="4">May</option>
                                <option value="5">June</option>
                                <option value="6">July</option>
                                <option value="7">August</option>
                                <option value="8">September</option>
                                <option value="9">October</option>
                                <option value="10">November</option>
                                <option value="11">December</option>
                            </select>
                        </div>
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
