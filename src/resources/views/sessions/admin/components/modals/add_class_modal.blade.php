<div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="/add_class" method="post">
                @csrf
                <div class="modal-body">
                    <h4 class="text-center text-primary">Create Class</h4>
                    <div class="row g-3">
                        <div class="col">
                            <label for="class_name">Class Name:</label>
                            <input type="text" name="class_name" id="class_name" class="form-control" required>
                        </div>
                    </div>
                    <label for="#classExcerpt">Excerpt:</label>
                    <input type="text" name="class_excerpt" id="classExcerpt" class="form-control">

                    <label for="classDescription">Description:</label>
                    <textarea name="class_description" id="classDescription" cols="30" rows="10" class="form-control"></textarea>
                    <div class="row g-3">
                        <div class="col">
                            <label for="category">Select Category:</label>
                            <select name="category" id="category" class="select" aria-label="select-category" data-mdb-filter="true" data-mdb-container="#addClassModal" required>
                                <option selected>Choose Category</option>
                                @foreach($categorys as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="department">Select Department:</label>
                            <select name="department" id="department" class="select" aria-label="select-department" data-mdb-filter="true" data-mdb-container="#addClassModal" required>
                                <option selected>Choose Department</option>
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col">
                            <label for="instructor">Select Instructor:</label>
                            <select name="instructor" id="instructor" class="select" aria-label="select-instructor" data-mdb-filter="true" data-mdb-container="#addClassModal" required>
                                <option selected>Choose Instructor</option>
                                @foreach($instructors as $instructor)
                                    <option value="{{$instructor->id}}">{{$instructor->first_name}} {{$instructor->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="learning_style">Select Learning Style:</label>
                            <select name="learning_style" id="learning_style" class="select" aria-label="select-learning_style" data-mdb-filter="true" data-mdb-container="#addClassModal" required>
                                <option selected>Choose Learning Style</option>
                                @foreach($learning_styles as $learning_style)
                                    <option value="{{$learning_style->id}}">{{$learning_style->name}}</option>
                                @endforeach
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
