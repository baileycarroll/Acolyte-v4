<div class="card mb-2">
    <div class="card-header bg-primary">
        <h3 class="text-center text-white">Class Spotlight</h3>
    </div>
    <div class="card-body">
        <h4 class="text-center text-primary">{{$spotlight_class->name}}</h4>
        <h5 class="text-muted text-center">
            <small><em>
                    By: {{App\Models\User::where('id', '=', $spotlight_class->instructor)->first()->first_name .' '.App\Models\User::where('id', '=', $spotlight_class->instructor)->first()->last_name }}
                </em></small>
        </h5>
        <p class="text-center">
        <h5 class="text-primary">Excerpt</h5>
        <p>{{$spotlight_class->excerpt}}</p>
        <h6 class="text-primary">Description</h6>
        <p>{{$spotlight_class->description}}</p>
        </p>
        @if($user_contents->where('class', '=', $spotlight_class->id)->count() != 0)
            <button class="btn btn-primary align-self-end mt-3 mb-2 mx-2"><a class="text-light" href="/view_class/{{$spotlight_class->id}}">View Content</a></button>
        @else
            <form action="/add_to_user_content" method="post">
                @csrf
                <input type="hidden" name="type" value="class">
                <input type="hidden" name="class" value="{{$spotlight_class->id}}">
                <button type="submit" class="btn btn-primary mt-3 mb-2 mx-2">Sign Me Up!</button>
            </form>
        @endif
    </div>
</div>
