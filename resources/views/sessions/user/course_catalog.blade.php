@extends('layout')
@section('main')
    <header>
        @include("components/sidebar")

        @include("components/navbar")
    </header>
    <main style="margin-top: 5vh">
        <nav class="navbar navbar-expand-lg py-3 px-5 w-100 bg-light">
            <div class="container-fluid d-flex justify-content-between py-2">
                <div class="align-self-start d-none d-xl-block">
                    <div class="collapse navbar-collapse" id="content-types-dropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <button class="btn btn-primary dropdown-toggle rounded-9" data-mdb-toggle="dropdown" aria-expanded="false">Category</button>
                                <ul class="dropdown-menu">
                                    @foreach($categories as $category)
                                        <li><a href="/course_catalog?category={{$category->id}}" class="dropdown-item">{{$category->name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="align-self-center">
                    <h2 class="text-primary text-center">Course Catalog</h2>
                </div>
                <div class="align-self-end">
                    <form action="" method="get">
                        <div class="input-group">
                            <div class="form-outline">
                                <input type="search" id="search" name="search" class="form-control" value="{{request('search')}}"/>
                                <label class="form-label" for="search">Search</label>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
        <div class="container-fluid pt-4 px-5">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-8 mt-4">
                @if($courses->isNotEmpty())
                    @foreach($courses as $course)
                        @if($course -> status == 'Active')
                        <div class="col">
                            <div class="card">
                                <div class="ratio ratio-16x9">
                                    <img
                                        src="{{ \Illuminate\Support\Facades\Storage::temporaryUrl("thumbnails/".\App\Models\Course::find($course->id)->name.'/'.\App\Models\Course::find($course->id)->name.'.jpg', now()->addMinutes(10))}}"
                                        alt="Course Thumbnail"
                                        class="rounded"
                                    >
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-center text-primary">{{$course->name}}</h5>
                                    <p class="card-text">{{$course->description}}</p>
                                    <div class="chip chip-outline btn-outline-primary text-primary fw-bold w-50" data-mdb-ripple-color="dark">{{\App\Models\Category::where('id', '=', $course->category_1)->first()->name}}</div>
                                    @if(\App\Models\Category::where('id', '=', $course->category_2)->first())
                                        <div class="chip chip-outline btn-outline-primary text-primary fw-bold w-50" data-mdb-ripple-color="dark">{{\App\Models\Category::where('id', '=', $course->category_2)->first()->name}}</div>
                                    @endif
                                    @if(\App\Models\Category::where('id', '=', $course->category_3)->first())
                                        <div class="chip chip-outline btn-outline-primary text-primary fw-bold w-50" data-mdb-ripple-color="dark">{{\App\Models\Category::where('id', '=', $course->category_3)->first()->name}}</div>
                                    @endif
                                </div>
                                @if($user_contents->where('course', '=', $course->id)->count() != 0)
                                    <button class="btn btn-primary align-self-end mt-3 mb-2 mx-2"><a class="text-light" href="/view_course/{{$course->id}}">View Content</a></button>
                                @else
                                    <form action="/add_to_user_content" method="post" class="align-self-end">
                                        @csrf
                                        <input type="hidden" name="type" value="course">
                                        <input type="hidden" name="class" value="{{$course->id}}">
                                        <button type="submit" class="btn btn-primary mt-3 mb-2 mx-2">Sign Me Up!</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </main>
@endsection
