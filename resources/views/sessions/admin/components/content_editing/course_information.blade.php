<div class="row">
    <div class="col-sm-12 col-lg-6 mt-2">
        <div class="card mt-4 h-100">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="align-self-start">
                        <div class="input-group">
                            <button class="btn btn-primary rounded"><a class="text-white text-decoration-none" href="/courses">Back to Course List</a></button>
                        </div>
                    </div>
                    <div class="align-self-end">
                        <form action="/set_spotlight_course" method="post" class="align-self-end">
                            @csrf
                            <input type="hidden" name="id" value="{{$course->id}}">
                            <button type="submit" class="btn btn-primary rounded">Set As Spotlight Course</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="/update_course" method="POST">
                    @csrf
                    <input type="hidden" name="course_id" value="{{$course->id}}">
                    <div class="row g-3">
                        <div class="col">
                            <label for="class_name">Course Name:</label>
                            <input type="text" name="course_name" id="course_name" class="form-control" value="{{$course->name}}" >
                        </div>
                        <div class="col">
                            <label for="status">Status:</label>
                            <select data-mdb-filter="true" name="status" id="status" class="select" >
                                <option value="{{$course->status}}" selected>Selected: {{$course->status}}</option>
                                <option value="Active">Active</option>
                                <option value="Pending">Pending</option>
                                <option value="Suspended">Suspended</option>
                                <option value="Deactivated">Deactivated</option>
                            </select>
                        </div>
                    </div>
                    <label for="#coursesExcerpt">Excerpt:</label>
                    <input type="text" name="course_excerpt" id="courseExcerpt" class="form-control" value="{{$course->excerpt}}">

                    <label for="courseDescription">Description:</label>
                    <textarea name="course_description" id="courseDescription" cols="20" rows="5" class="form-control">{{$course->description}}</textarea>
                    <div class="row g-3">
                        <div class="col">
                            <label for="category">Select Category:</label>
                            <select data-mdb-filter="true" name="category" id="category" class="select"  aria-label="select-category">
                                <option value="{{$course->category_1}}" selected>Selected: {{$course->category_name}}</option>
                                @foreach($categorys as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="department">Select Department:</label>
                            <select data-mdb-filter="true" name="department" id="department" class="select"  aria-label="select-department">
                                <option value="{{$course->department}}" selected>Selected: {{$course->department_name}}</option>
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col">
                            <label for="instructor">Select Instructor:</label>
                            <select data-mdb-filter="true" name="instructor" id="instructor" class="select"  aria-label="select-instructor">
                                <option value="{{$course->instructor}}" selected>Selected: {{$course->instructor_fname}} {{$course->instructor_lname}}</option>
                                @foreach($instructors as $instructor)
                                    <option value="{{$instructor->id}}">{{$instructor->first_name}} {{$instructor->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="learning_style">Select Learning Style:</label>
                            <select data-mdb-filter="true" name="learning_style" id="learning_style" class="select"  aria-label="select-learning_style">
                                <option value="{{$course->learning_style}}" selected>Selected: {{$course->ls_name}}</option>
                                @foreach($learning_styles as $learning_style)
                                    <option value="{{$learning_style->id}}">{{$learning_style->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-50">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-3 mt-2">
        <div class="card mt-4 h-100">
            <div class="card-header bg-primary">
                <h4 class="text-center text-light">Course Thumbnail</h4>
            </div>
            <div class="card-body text-center">
                @if( \App\Http\Controllers\ContentController::verifyContentExists($filepath) == 1)
                    <div class="ratio ratio-16x9">
                        <img src="{{ \Illuminate\Support\Facades\Storage::temporaryUrl($filepath, now()->addMinutes(10))}}" alt="Course Thumbnail">
                    </div>
                    <form action="/upload_course_thumbnail" class="align-self-center mt-3" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="course_name" value="{{$course->name}}">
                        <input type="hidden" name="course_id" value="{{$course->id}}">
                        <label class="form-label" for="course_thumbnail">Course Thumbnail</label>
                        <input type="file" class="form-control" id="course_thumbnail" name="course_thumbnail"/>
                        <button type="submit" class="btn btn-primary w-50 mt-3">Upload Thumbnail</button>
                    </form>
                @else
                    <h4>No Thumbnail Found</h4>
                    <form action="/upload_course_thumbnail" class="align-self-center" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="course_name" value="{{$course->name}}">
                        <input type="hidden" name="course_id" value="{{$course->id}}">
                        <label class="form-label" for="course_thumbnail">Course Thumbnail</label>
                        <input type="file" class="form-control" id="course_thumbnail" name="course_thumbnail"/>
                        <button type="submit" class="btn btn-primary w-50 mt-3">Upload Thumbnail</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-3 mt-2">
        <div class="card mt-4 h-100">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="align-self-start">
                        <div class="input-group d-none">
                            @can('UpdateGrade')
                                <button class="btn btn-primary rounded">Re-Calculate</button>
                            @endcan
                        </div>
                    </div>
                    <div class="align-self-end">
                        <div class="text-muted">Last Quiz Graded: {{$last_graded}}</div>
                    </div>
                </div>
            </div>
            <div class="card-body text-center">
                <h3 class="text-primary">Avg. Course Grade</h3>
                <h2 class="text-center text-primary">{{$avg_grade}} %</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-sm-12 col-lg-6 mt-2">
        <div class="card mt-4 h-100">
            <div class="card-header bg-primary">
                <h3 class="text-light text-center">Course Modules</h3>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <div class="align-self-start">
                        <div class="input-group">
                            @can('CreateContent')
                                <button class="btn btn-primary rounded" data-mdb-toggle="modal" data-mdb-target="#addModuleModal">Add Module</button>
                            @endcan
                        </div>
                    </div>
                    <div class="align-self-center w-50">
                        <div class="form-outline">
                            <input class="form-control rounded" type="search" id="module-search" placeholder="Search Modules" aria-label="Search Modules">
                        </div>
                    </div>
                    <div class="align-self-end">
                        <div class="input-group d-none">
                            <button class="btn btn-primary">Export</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <div id="modules-datatable" data-mdb-loading="true"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener("load", (e) => {
        getModules();
    });
    // Awards Table
    window.getModules = function() {
        const columns = [
            {label: 'Actions', field: 'actions'},
            {label: 'Module Name', field: 'name'},
            {label: 'Status', field: 'status'},
            {label: 'Available On', field: 'available_on'},
            {label: 'Unavailable On', field: 'not_available'},
            {label: 'Last Updated', field: 'updated_at'},
        ];
        const asyncTable = new mdb.Datatable(
            document.getElementById('modules-datatable'),
            { columns,}
        );
        fetch("/api/getModules/{{$course->id}}")
            .then((response) => response.json())
            .then((data) => {
                asyncTable.update(
                    {
                        rows: data.map((row) => ({
                            ...row,
                            actions: `
                            <a href="/module_information/read/${row.id}" class="text-decoration-none text-light"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-info"></i></button></a>
                        @can('UpdateContent')
                            <a href="/module_information/${row.id}" class="text-decoration-none text-light"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-pen"></i></button></a>
                        @endcan
                            `,
                            name: row.name,
                            status: row.status,
                            available_on: row.available_on,
                            not_available: row.not_available,
                            updated_at: new Date(row.updated_at).toLocaleString("en-US", {timeZoneName: "short"}),
                        })),
                    },
                    { loading: false }
                );
            });
        document.getElementById('module-search').addEventListener('input', (e) => {
            asyncTable.search(e.target.value)
        });
    }
</script>
