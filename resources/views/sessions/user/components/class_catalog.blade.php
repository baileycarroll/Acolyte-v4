<div class="card">
    <div class="card-header bg-primary">
        <h3 class="text-center text-white">Available Classes</h3>
    </div>
    <div class="card-body">
        <div class="row row-cols-md-3 row-cols-sm-2 row-cols-xs-1 g-4">
            @foreach($classes as $class)
                <div class="col">
                    <div class="card">
                        <div class="ratio ratio-16x9">
                            <img class="rounded" src="{{
                                \Illuminate\Support\Facades\Storage::temporaryUrl("thumbnails/classes/".\App\Models\Classes::find($class->id)->name.'/'.\App\Models\Classes::find($class->id)->name.'.jpg', now()->addMinutes(10))
                                }}" alt="Class Thumbnail Image">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center text-primary">{{$class->name}}</h5>
                            <p class="card-text">{{$class->description}}</p>
                        </div>
                        @if($user_contents->where('class', '=', $class->id)->count() != 0)
                            <button class="btn btn-primary align-self-end mt-3 mb-2 mx-2"><a class="text-light" href="/view_class/{{$class->id}}">View Content</a></button>
                        @else
                            <form action="/add_to_user_content" method="post" class="align-self-end">
                                @csrf
                                <input type="hidden" name="type" value="class">
                                <input type="hidden" name="class" value="{{$class->id}}">
                                <button type="submit" class="btn btn-primary mt-3 mb-2 mx-2">Sign Me Up!</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
