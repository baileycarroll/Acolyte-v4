<div class="row">
    <div class="col-sm-12 col-lg-6 mt-2">
        <div class="card mt-4 h-100">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="align-self-start">
                        <div class="input-group">
                            <button class="btn btn-primary rounded"><a class="text-white text-decoration-none" href="/classes">Back to Class List</a></button>
                        </div>
                    </div>
                    <div class="align-self-end">
                        <form action="/set_spotlight_class" method="post" class="align-self-end">
                            @csrf
                            <input type="hidden" name="id" value="{{$class->id}}">
                            <button type="submit" class="btn btn-primary rounded">Set As Spotlight Class</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="/update_class" method="POST">
                    @csrf
                    <input type="hidden" name="class_id" value="{{$class->id}}">
                    <div class="row g-3">
                        <div class="col">
                            <label for="class_name">Class Name:</label>
                            <input type="text" name="class_name" id="class_name" class="form-control" value="{{$class->name}}" required>
                        </div>
                        <div class="col">
                            <label for="status">Status:</label>
                            <select name="status" id="status" class="select" data-mdb-filter="true">
                                 <option value="{{$class->status}}" selected>Selected: {{$class->status}}</option>
                                <option value="Active">Active</option>
                                <option value="Pending">Pending</option>
                                <option value="Suspended">Suspended</option>
                                <option value="Deactivated">Deactivated</option>
                            </select>
                        </div>
                    </div>
                    <label for="#classExcerpt">Excerpt:</label>
                    <input type="text" name="class_excerpt" id="classExcerpt" class="form-control" value="{{$class->excerpt}}">

                    <label for="classDescription">Description:</label>
                    <textarea name="class_description" id="classDescription" cols="20" rows="5" class="form-control">{{$class->description}}</textarea>
                    <div class="row g-3">
                        <div class="col">
                            <label for="category">Select Category:</label>
                            <select name="category" id="category" class="select" data-mdb-filter="true" aria-label="select-category" required>
                                <option value="{{$class->category_1}}" selected>Selected: {{$class->category_name}}</option>
                                @foreach($categorys as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="department">Select Department:</label>
                            <select name="department" id="department" class="select" data-mdb-filter="true" aria-label="select-department" required>
                                <option value="{{$class->department}}" selected>Selected: {{$class->department_name}}</option>
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col">
                            <label for="instructor">Select Instructor:</label>
                            <select name="instructor" id="instructor" class="select" data-mdb-filter="true" aria-label="select-instructor" required>
                                <option value="{{$class->instructor}}" selected>Selected: {{$class->instructor_fname}} {{$class->instructor_lname}}</option>
                                @foreach($instructors as $instructor)
                                    <option value="{{$instructor->id}}">{{$instructor->first_name}} {{$instructor->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="learning_style">Select Learning Style:</label>
                            <select name="learning_style" id="learning_style" class="select" data-mdb-filter="true" aria-label="select-learning_style" required>
                                <option value="{{$class->learning_style}}" selected>Selected: {{$class->ls_name}}</option>
                                @foreach($learning_styles as $learning_style)
                                    <option value="{{$learning_style->id}}">{{$learning_style->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn-primary btn mt-2 w-100">Update</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-3 mt-2">
        <div class="card mt-4 h-100">
            <div class="card-header bg-primary">
                <h4 class="text-center text-light">Class Thumbnail</h4>
            </div>
            <div class="card-body text-center">
                @if( \App\Http\Controllers\ContentController::verifyContentExists($thumb_filepath) == 1)
                    <div class="ratio ratio-16x9">
                        <img src="{{ \Illuminate\Support\Facades\Storage::temporaryUrl($thumb_filepath, now()->addMinutes(10))}}" alt="Class Thumbnail">
                    </div>
                    <form action="/upload_class_thumbnail" class="align-self-center mt-3" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="class_name" value="{{$class->name}}">
                        <input type="hidden" name="class_id" value="{{$class->id}}">
                        <label class="form-label" for="class_thumbnail">Class Thumbnail</label>
                        <input type="file" class="form-control" id="class_thumbnail" name="class_thumbnail"/>
                        <button type="submit" class="btn btn-primary w-50 mt-3">Upload Thumbnail</button>
                    </form>
                @else
                    <h4>No Thumbnail Found</h4>
                    <form action="/upload_class_thumbnail" class="align-self-center mt-3" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="class_name" value="{{$class->name}}">
                        <input type="hidden" name="class_id" value="{{$class->id}}">
                        <label class="form-label" for="class_thumbnail">Class Thumbnail</label>
                        <input type="file" class="form-control" id="class_thumbnail" name="class_thumbnail"/>
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
                <h3 class="text-primary">Avg. Class Grade</h3>
                <h2 class="text-center text-primary">{{$avg_grade}} %</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-sm-12 col-lg-6 mt-2">
        <div class="card mt-4 h-100">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="align-self-end">
                        <ul class="nav nav-pills" id="QuizContentTabList" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a
                                    href="#ContentTab"
                                    class="nav-link active"
                                    id="ContentTabPill"
                                    data-mdb-toggle="pill"
                                    role="tab"
                                    aria-controls="ContentTab"
                                    aria-selected="true"
                                >
                                    Media Content
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a
                                    href="#QuizTab"
                                    class="nav-link"
                                    id="QuizTabPill"
                                    data-mdb-toggle="pill"
                                    role="tab"
                                    aria-controls="QuizTab"
                                    aria-selected="false"
                                >
                                    Quiz Content
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body text-center">
                <div id="TabContent" class="tab-content">
                    <div id="ContentTab" class="tab-pane fade show active" role="tabpanel" aria-labelledby="ContentTab">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="align-self-start">
                                <div class="input-group">
                                    @can('CreateContent')
                                        <button class="btn btn-primary rounded" data-mdb-toggle="modal" data-mdb-target="#uploadClassContentModal">Upload Class Content</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        @if( \App\Http\Controllers\ContentController::verifyContentExists($filepath) == 1)
                            <div class="ratio ratio-16x9">
                                <video src="{{ \Illuminate\Support\Facades\Storage::temporaryUrl($filepath, now()->addMinutes(10)) }}" controls controlsList="nodownload"></video>
                            </div>
                        @else
                            <h4>No Content Found</h4>
                        @endif
                    </div>
                    <div id="QuizTab" class="tab-pane fade" role="tabpanel" aria-labelledby="QuizTab">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="align-self-start">
                                <div class="input-group">
                                    @can('CreateContent')
                                        <button class="btn btn-primary rounded" data-mdb-toggle="modal" data-mdb-target="#createClassQuizModal">Create Quiz</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        @if($quizzes == NULL )
                            <h4 class="text-center">No Quiz Found!</h4>
                        @endif
                        @if($quizzes != NULL)
                            @foreach($quizzes as $quiz)
                                <div class="container">
                                    <form action="/update_class_quiz" method="POST">
                                        @csrf
                                        <input type="hidden" name="class_id" value="{{$class->id}}">
                                        <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
                                        <h3 class="text-primary text-center">{{$class->name}} Quiz</h3>
                                        <label for="num_questions">Number of Question? <small>Minimum is 3</small></label>
                                        <select name="num_questions" id="num_questions" class="select" data-mdb-filter="true" required>
                                            <option value="{{$quiz->num_questions}}">Selected: {{$quiz->num_questions}}</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                        @for($i = 1; $i <= $quiz->num_questions; $i++)
                                            <div class="p-3 mt-3">
                                                <label for="question{{$i}}">Question {{$i}}</label>
                                                <input type="text" name="question_{{$i}}" id="question_{{$i}}" class="form-control" value="{{$quiz->{"question_".$i} }}">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="q{{$i}}_opt_1">Question {{$i}} Option 1</label>
                                                        <input type="text" name="q{{$i}}_opt_1" id="q{{$i}}_opt_1" class="form-control" value="{{$quiz->{"q".$i."_opt_1"} }}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="q{{$i}}_opt_2">Question {{$i}} Option 2</label>
                                                        <input type="text" name="q{{$i}}_opt_2" id="q{{$i}}_opt_2" class="form-control" value="{{$quiz->{"q".$i."_opt_2"} }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="q{{$i}}_opt_3">Question {{$i}} Option 3</label>
                                                        <input type="text" name="q{{$i}}_opt_3" id="q{{$i}}_opt_3" class="form-control" value="{{$quiz->{"q".$i."_opt_3"} }}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="q{{$i}}_correct">Question {{$i}} Correct Answer</label>
                                                        <input type="text" name="q{{$i}}_correct" id="q{{$i}}_correct" class="form-control" value="{{$quiz->{"q".$i."_correct"} }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                        <button type="submit" class="btn btn-primary w-50">Update</button>
                                    </form>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6 mt-2">
        <div class="card mt-4 h-100">
            <div class="card-header py-3 text-light bg-primary display-6 text-center">Users In Class</div>
            <div class="card-body">
                <div class="d-flex justify-content-center mb-3">
                    <div class="align-self-center w-50">
                        <div class="form-outline">
                            <input class="form-control rounded" type="search" id="class-user-search" placeholder="Search Users In Class" aria-label="Search Users In Class">
                        </div>
                    </div>
                </div>
                <div id="class-users-datatable" data-mdb-loading="true"></div>
            </div>
        </div>
    </div>
</div>
<script>
    //Class Users Table
    window.getClassUsers = function() {
        const columns = [
            {label: 'Actions', field: 'actions'},
            {label: 'Full Name', field: 'full_name'},
            {label: 'Email', field: 'email'},
            {label: 'Phone', field: 'phone'},
            {label: 'Account Status', field: 'status'},
        ];
        const asyncTable = new mdb.Datatable(
            document.getElementById('class-users-datatable'),
            { columns,}
        );
        fetch("/api/getUsersWithClass/{{$class->id}}")
            .then((response) => response.json())
            .then((data) => {
                asyncTable.update(
                    {
                        rows: data.map((row) => ({
                            ...row,
                            actions: `
                        <a href="/user_information/${row.id}" class="text-decoration-none text-light"><button class="btn ms-2 btn-primary btn-floating btn-sm"><i class="fa-solid fa-info"></i></button></a>
                        <button class="btn ms-2 btn-primary btn-floating btn-sm d-none"><i class="fa-solid fa-envelope"></i></button>
                        `,
                            full_name: row.first_name+" "+row.last_name,
                            email: row.email,
                            phone: row.phone,
                            status: row.user_status,
                        })),
                    },
                    { loading: false }
                );
            });
        document.getElementById('class-user-search').addEventListener('input', (e) => {
            asyncTable.search(e.target.value)
        });
    }
    window.addEventListener("load", (e) => {
        getClassUsers();
    });
</script>

