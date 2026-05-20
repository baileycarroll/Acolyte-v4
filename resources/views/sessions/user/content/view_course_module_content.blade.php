<div class="row">
    <div class="col-sm-12 col-lg-8 mt-2">
        <div class="card mt-4 h-100">
            <div class="card-header bg-primary">
                <h2 class="text-center text-light">
                    {{$course->name}}
                    <h3 class="text-center text-light">Module: {{$module->name}}</h3>
                    <h4 class="text-center text-light"><em><small>By: {{App\Models\User::find($course->instructor)->first_name .' '.App\Models\User::find($course->instructor)->last_name}}</small></em></h4>
                </h2>
            </div>
            <div class="card-body">
                <div class="ratio ratio-16x9">
                    <video src="{{ \Illuminate\Support\Facades\Storage::temporaryUrl($content, now()->addMinutes(10)) }}" controls controlsList="nodownload"></video>
                </div>
                <div class="border-top mt-2 py-2">
                    <p><strong class="text-primary">Description: </strong>{{$module->description}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mt-2">
        <div class="card mt-4">
            <div class="card-header bg-primary">
                <h2 class="text-center text-light">Additional Resources</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <ul class="nav nav-pills nav-justified mb-3" id="resource_pills" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#notes" class="nav-link active" id="notes_tab" data-mdb-toggle="pill" role="tab" aria-controls="notes" aria-selected="true">Notes</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#related" class="nav-link" id="related_tab" data-mdb-toggle="pill" role="tab" aria-controls="related" aria-selected="true">Related Modules</a>
                            </li>
                            @if($show_quiz != 0)
                                <li class="nav-item" role="presentation">
                                    <a href="#quiz" class="nav-link" id="quiz_tab" data-mdb-toggle="pill" role="tab" aria-controls="quiz" aria-selected="true">Quiz</a>
                                </li>
                            @endif
                            <li class="nav-item" role="presentation">
                                <a href="#grade" class="nav-link" id="grade_tab" data-mdb-toggle="pill" role="tab" aria-controls="grade" aria-selected="true">My Grade</a>
                            </li>
                        </ul>
                        <div class="tab-content border-top mt-2 mb-2" id="resource_content">
                            <div class="tab-pane fade show active" id="notes" role="tabpanel" aria-labelledby="notes">
                                <div class="wysiwyg shadow" data-mdb-wysiwyg="wysiwyg"></div>
                            </div>
                            <div class="tab-pane fade" id="related" role="tabpanel" aria-labelledby="notes">
                                <div class="list-group list-group-light mt-2 py-2">
                                    @foreach($modules as $module_)
                                        <a href="/view_course/{{$course->id}}/view_module/{{$module_->id}}" class="list-group-item list-group-item-primary px-3 ripple">{{$module_->name}}</a>
                                    @endforeach
                                    @if($modules->isEmpty())
                                        <h4 class="text-center text-primary">No Additional Modules At This Time</h4>
                                    @endif
                                </div>
                            </div>
                            @if($show_quiz != 0)
                                <div class="tab-pane fade" id="quiz" role="tabpanel" aria-labelledby="notes">
                                    <h5 class="text-center text-primary mt-2">{{$module->name}} Quiz</h5>
                                    @if($quiz != NULL)
                                        <form action="/grade_quiz" method="post">
                                            @csrf
                                            <input type="hidden" name="quiz" value="{{$quiz->id}}">
                                            <input type="hidden" name="content_type" value="module">
                                            <input type="hidden" name="module" value="{{$module->id}}">
                                            @for($i = 1; $i <= $quiz->num_questions; $i++)
                                                <div class="p-3 mt-3">
                                                    <p><strong>Question {{$i}}: </strong>{{$quiz->{"question_".$i} }}</p>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="q{{$i}}" id="q{{$i}}_opt_1" value="{{$quiz->{"q".$i."_opt_1"} }}">
                                                        <label for="q{{$i}}_opt_1">{{$quiz->{"q".$i."_opt_1"} }}</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="q{{$i}}" id="q{{$i}}_opt_2" value="{{$quiz->{"q".$i."_opt_2"} }}">
                                                        <label for="q{{$i}}_opt_2">{{$quiz->{"q".$i."_opt_2"} }}</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="q{{$i}}" id="q{{$i}}_opt_3" value="{{$quiz->{"q".$i."_opt_3"} }}">
                                                        <label for="q{{$i}}_opt_3">{{$quiz->{"q".$i."_opt_3"} }}</label>
                                                    </div>
                                                </div>
                                            @endfor
                                            <button type="submit" class="btn btn-primary w-100 mt-4">Submit</button>
                                        </form>
                                    @else
                                        <h3 class="text-center text-primary">No Quiz Found</h3>
                                    @endif
                                </div>
                            @endif
                            <div class="tab-pane fade" id="grade" role="tabpanel" aria-labelledby="grade">
                                <h2 class="text-center text-primary mt-2">{{$module->name}} Grade:</h2>
                                <h3 class="text-primary text-center">
                                    @if($grade != NULL)
                                        {{$grade}}%
                                    @else
                                    No Grade Found!
                                    @endif
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
