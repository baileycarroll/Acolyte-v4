<div class="row">
    <div class="col-sm-12 col-lg-8 mt-2">
        <div class="card mt-4 h-100">
            <div class="card-header bg-primary">
                <h2 class="text-center text-light">
                    {{$course->name}}
                    <h4 class="text-center text-light"><em><small>By: {{App\Models\User::find($course->instructor)->first_name .' '.App\Models\User::find($course->instructor)->last_name}}</small></em></h4>
                </h2>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <div class="w-50">
                        <img src="{{\Illuminate\Support\Facades\Storage::temporaryUrl("thumbnails/".\App\Models\Course::find($course->id)->name.'/'.\App\Models\Course::find($course->id)->name.'.jpg', now()->addMinutes(10))}}"
                             alt="Course Thumbnail" class="img-fluid rounded">
                    </div>
                </div>
                <div class="py-2">
                    <p><strong class="text-primary">Excerpt: </strong>{{$course->excerpt}}</p>
                    <p><strong class="text-primary">Description: </strong>{{$course->description}}</p>
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
                                <a href="#related" class="nav-link active" id="related_tab" data-mdb-toggle="pill" role="tab" aria-controls="related" aria-selected="true">Related Modules</a>
                            </li>
                        </ul>
                        <div class="tab-content border-top mt-2 mb-2" id="resource_content">
                            <div class="tab-pane fade show active" id="related" role="tabpanel" aria-labelledby="notes">
                                <div class="list-group list-group-light mt-2 py-2">
                                    @foreach($modules as $module)
                                        <a href="/view_course/{{$course->id}}/view_module/{{$module->id}}" class="list-group-item list-group-item-primary px-3 ripple">{{$module->name}}</a>
                                    @endforeach
                                    @if($modules->isEmpty())
                                        <h4 class="text-center text-primary">No Additional Modules At This Time</h4>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
