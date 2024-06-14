<div class="card mb-2">
    <div class="card-header bg-primary">
        <h3 class="text-center text-white">Course Spotlight</h3>
    </div>
    <div class="card-body">
        <h4 class="text-center text-primary">{{$spotlight_course->name}}</h4>
        <h5 class="text-muted text-center">
            <small><em>
                    By: {{App\Models\User::where('id', '=', $spotlight_course->instructor)->first()->first_name .' '.App\Models\User::where('id', '=', $spotlight_course->instructor)->first()->last_name }}
                </em></small>
        </h5>
        <p class="text-center">
        <h5 class="text-primary">Excerpt</h5>
        <p>{{$spotlight_course->excerpt}}</p>
        <h6 class="text-primary">Description</h6>
        <p>{{$spotlight_course->description}}</p>
        </p>
        @if($user_contents->where('course', '=', $spotlight_course->id)->count() != 0)
            <button class="btn btn-primary align-self-end mt-3 mb-2 mx-2"><a class="text-light" href="/view_course/{{$spotlight_course->id}}">View Content</a></button>
        @else
            <form action="/add_to_user_content" method="post">
                @csrf
                <input type="hidden" name="type" value="course">
                <input type="hidden" name="course" value="{{$spotlight_course->id}}">
                <button type="submit" class="btn btn-primary mt-3 mb-2 mx-2">Sign Me Up!</button>
            </form>
        @endif
    </div>
</div>
