<div class="row">
    <div class="col-sm-12 col-lg-6 mt-2">
        <div class="card mt-4 h-100">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="align-self-start">
                        <div class="input-group">
                            <button class="btn btn-primary rounded"><a class="text-white text-decoration-none" href="/course_information/{{$module->course}}">Back to Course Information</a></button>
                        </div>
                    </div>
                    <div class="align-self-end">
                        {{--                        <div class="text-muted">Last Updated: {{$class->updated_at}}</div>--}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                <input type="hidden" name="module_id" value="{{$module->id}}">
                <div class="row g-3">
                    <div class="col">
                        <label for="name">Module Name:</label>
                        <input type="text" name="name" id="class_name" class="form-control" value="{{$module->name}}" disabled>
                    </div>
                    <div class="col">
                        <label for="status">Status:</label>
                        <select name="status" id="status" class="select" data-mdb-filter="true" disabled>
                            <option value="{{$module->status}}" selected>Selected: {{$module->status}}</option>
                            <option value="Active">Active</option>
                            <option value="Pending">Pending</option>
                            <option value="Suspended">Suspended</option>
                            <option value="Deactivated">Deactivated</option>
                        </select>
                    </div>
                </div>

                <label for="description">Description:</label>
                <textarea name="description" id="description" cols="20" rows="5" class="form-control" disabled>{{$module->description}}</textarea>

                <div class="d-flex justify-content-evenly">
                    <div class="form-outline datepicker mt-3" data-mdb-format="yyyy-mm-dd">
                        <input type="text" name="available_on" id="available_on" class="form-control" value="{{$module->available_on}}" disabled>
                        <label for="available_in" class="form-label">Available On:</label>
                    </div>
                    <div class="form-outline datepicker mt-3" data-mdb-format="yyyy-mm-dd">
                        <input type="text" name="not_available" id="unavailable_on" class="form-control" value="{{$module->not_available}}" disabled>
                        <label for="unavailable_in" class="form-label">Unavailable On:</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6 mt-2">
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
                <h3 class="text-primary">Avg. Module Grade</h3>
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
                                        <button class="btn btn-primary rounded" data-mdb-toggle="modal" data-mdb-target="#uploadModuleContentModal">Upload Module Content</button>
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
                        @if($quizzes == NULL )
                            <h4 class="text-center">No Quiz Found!</h4>
                        @endif
                        @if($quizzes != NULL)
                            @foreach($quizzes as $quiz)
                                <div class="container">
                                    <input type="hidden" name="module_id" value="{{$module->id}}">
                                    <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
                                    <h3 class="text-primary text-center">{{$module->name}} Quiz</h3>
                                    <label for="num_questions">Number of Question? <small>Minimum is 3</small></label>
                                    <select name="num_questions" id="num_questions" class="form-select" disabled>
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
                                            <input type="text" name="question_{{$i}}" id="question_{{$i}}" class="form-control" value="{{$quiz->{"question_".$i} }}" disabled>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="q{{$i}}_opt_1">Question {{$i}} Option 1</label>
                                                    <input type="text" name="q{{$i}}_opt_1" id="q{{$i}}_opt_1" class="form-control" value="{{$quiz->{"q".$i."_opt_1"} }}" disabled>
                                                </div>
                                                <div class="col">
                                                    <label for="q{{$i}}_opt_2">Question {{$i}} Option 2</label>
                                                    <input type="text" name="q{{$i}}_opt_2" id="q{{$i}}_opt_2" class="form-control" value="{{$quiz->{"q".$i."_opt_2"} }}" disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="q{{$i}}_opt_3">Question {{$i}} Option 3</label>
                                                    <input type="text" name="q{{$i}}_opt_3" id="q{{$i}}_opt_3" class="form-control" value="{{$quiz->{"q".$i."_opt_3"} }}" disabled>
                                                </div>
                                                <div class="col">
                                                    <label for="q{{$i}}_correct">Question {{$i}} Correct Answer</label>
                                                    <input type="text" name="q{{$i}}_correct" id="q{{$i}}_correct" class="form-control" value="{{$quiz->{"q".$i."_correct"} }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

