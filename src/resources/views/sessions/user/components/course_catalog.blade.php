<div class="card">
    <div class="card-header bg-primary">
        <h3 class="text-center text-white">Available Courses</h3>
    </div>
    <div class="card-body">
        <div class="row row-cols-md-3 row-cols-sm-2 row-cols-xs-1 g-4">
            @foreach($courses as $course)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="ratio ratio-16x9">
                            <img class="rounded" src="{{
                                \Illuminate\Support\Facades\Storage::temporaryUrl("thumbnails/".\App\Models\Course::find($course->id)->name.'/'.\App\Models\Course::find($course->id)->name.'.jpg', now()->addMinutes(10))
                                }}" alt="Course Thumbnail Image">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center text-primary">{{$course->name}}</h5>
                            <p class="card-text">{{$course->description}}</p>
                        </div>
                        @if($user_contents->where('course', '=', $course->id)->count() != 0)
                            <button class="btn btn-primary align-self-end mt-3 mb-2 mx-2"><a class="text-light" href="/view_course/{{$course->id}}">View Content</a></button>
                        @else
                            <form action="/add_to_user_content" method="post" class="align-self-end">
                                @csrf
                                <input type="hidden" name="type" value="course">
                                <input type="hidden" name="course" value="{{$course->id}}">
                                <button type="submit" class="btn btn-primary mt-3 mb-2 mx-2">Sign Me Up!</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
