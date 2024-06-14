<div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="/create_course" method="post">
                @csrf
                <div class="modal-body">
                    <h4 class="text-center text-primary">Create Course</h4>
                    <div class="row g-3">
                        <div class="col">
                            <label for="course_name">Course Name:</label>
                            <input type="text" name="course_name" id="course_name" class="form-control" required>
                        </div>
                    </div>
                    <label for="#courseExcerpt">Excerpt:</label>
                    <input type="text" name="course_excerpt" id="courseExcerpt" class="form-control">

                    <label for="courseDescription">Description:</label>
                    <textarea name="course_description" id="courseDescription" cols="30" rows="10" class="form-control"></textarea>
                    <div class="row g-3">
                        <div class="col">
                            <label for="category">Select Category:</label>
                            <select name="category" id="category" class="select" aria-label="select-category" data-mdb-filter="true" data-mdb-container="#addCourseModal" required>
                                <option selected>Choose Category</option>
                                @foreach($categorys as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="department">Select Department:</label>
                            <select name="department" id="department" class="select" aria-label="select-department" data-mdb-filter="true" data-mdb-container="#addCourseModal" required>
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
                            <select name="instructor" id="instructor" class="select" aria-label="select-instructor" data-mdb-filter="true" data-mdb-container="#addCourseModal" required>
                                <option selected>Choose Instructor</option>
                                @foreach($instructors as $instructor)
                                    <option value="{{$instructor->id}}">{{$instructor->first_name}} {{$instructor->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="learning_style">Select Learning Style:</label>
                            <select name="learning_style" id="learning_style" class="select" aria-label="select-learning_style" data-mdb-filter="true" data-mdb-container="#addCourseModal" required>
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
