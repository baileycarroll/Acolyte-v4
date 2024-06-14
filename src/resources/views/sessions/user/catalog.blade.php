@extends('layout')
@section('main')
    <header>
        @include("components/sidebar")

        @include("components/navbar")
    </header>
    <main style="margin-top: 58px">
        <nav class="navbar navbar-expand-lg py-3 px-5 w-100 bg-light">
            <div class="container-fluid d-flex justify-content-between">
                <div class="align-self-start d-none d-xl-block">
                    <div class="collapse navbar-collapse" id="content-types-dropdown">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item me-3">
                                <button class="btn btn-primary dropdown-toggle rounded-9" data-mdb-toggle="dropdown" aria-expanded="false">Content Type</button>
                                <ul class="dropdown-menu">
                                    @foreach($content_types as $content_type)
                                        <form action="" method="GET">
                                            <input type="hidden" name="content_type" value="{{$content_type->name}}">
                                            <button type="submit" class="dropdown-item rounded-5">{{$content_type->name}}</button>
                                        </form>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="nav-item">
                                <button class="btn btn-primary dropdown-toggle rounded-9" data-mdb-toggle="dropdown" aria-expanded="false">Category</button>
                                <ul class="dropdown-menu">
                                    @foreach($categories as $category)
                                        <form action="" method="GET">
                                            <input type="hidden" name="category" value="{{$category->id}}">
                                            <button type="submit" class="dropdown-item rounded-5">{{$category->name}}</button>
                                        </form>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="nav-item ms-3 d-none">
                                <form action="" method="GET">
                                    <button class="btn btn-primary dropdown-toggle rounded-9">Instructor</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="align-self-center">
                    <h2 class="text-primary text-center">Content Catalog</h2>
                </div>
                <div class="align-self-end">
                    <div class="input-group">
                        <div class="form-outline d-none">
                            <input type="search" id="form1" class="form-control" />
                            <label class="form-label" for="form1">Search</label>
                        </div>
                        <button type="button" class="btn btn-primary d-none">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container-fluid pt-4 px-5">
            <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 mt-4">
                @foreach($contents as $content)
                    <div class="col">
                        <div class="card">
                            <div class="ratio ratio-16x9">
                                @if($content->content_type === 1)
                                    <img
                                        src="{{ \Illuminate\Support\Facades\Storage::temporaryUrl("thumbnails/".\App\Models\Course::find($content->id)->name.'/'.\App\Models\Course::find($content->id)->name.'.jpg', now()->addMinutes(10))}}"
                                        alt="Course Thumbnail"
                                        class="rounded"
                                    >
                                    <div class="card-body">
                                        <h5 class="card-title text-center text-primary">{{$content->name}}</h5>
                                        <p class="card-text">{{$content->description}}</p>
                                        <div class="chip chip-outline btn-outline-primary" data-mdb-ripple-color="dark">
                                            Primary
                                            <i class="close fas fa-times"></i>
                                        </div>
                                    </div>
                                    @if($user_contents->where('course', '=', $content->id)->count() != 0)
                                        <button class="btn btn-primary align-self-end mt-3 mb-2 mx-2"><a class="text-light" href="/view_course/{{$content->id}}">View Content</a></button>
                                    @else
                                        <form action="/add_to_user_content" method="post" class="align-self-end">
                                            @csrf
                                            <input type="hidden" name="type" value="course">
                                            <input type="hidden" name="course" value="{{$content->id}}">
                                            <button type="submit" class="btn btn-primary mt-3 mb-2 mx-2">Sign Me Up!</button>
                                        </form>
                                    @endif
                                @else
                                    <img
                                        class="rounded"
                                        src="{{\Illuminate\Support\Facades\Storage::temporaryUrl("thumbnails/classes/".\App\Models\Classes::find($content->id)->name.'/'.\App\Models\Classes::find($content->id)->name.'.jpg', now()->addMinutes(10))}}"
                                        alt="Class Thumbnail Image"
                                    >
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-center text-primary">{{$content->name}}</h5>
                                        <p class="card-text">{{$content->description}}</p>
                                        <div class="chip chip-outline btn-outline-primary text-primary fw-bold w-25" data-mdb-ripple-color="dark">{{\App\Models\Category::where('id', '=', $content->category_1)->first()->name}}</div>
                                        @if(\App\Models\Category::where('id', '=', $content->category_2)->first())
                                            <div class="chip chip-outline btn-outline-primary text-primary fw-bold w-25" data-mdb-ripple-color="dark">{{\App\Models\Category::where('id', '=', $content->category_2)->first()->name}}</div>
                                        @endif
                                        @if(\App\Models\Category::where('id', '=', $content->category_3)->first())
                                            <div class="chip chip-outline btn-outline-primary text-primary fw-bold w-25" data-mdb-ripple-color="dark">{{\App\Models\Category::where('id', '=', $content->category_3)->first()->name}}</div>
                                        @endif
                                    </div>
                                    @if($user_contents->where('class', '=', $content->id)->count() != 0)
                                        <button class="btn btn-primary align-self-end mt-3 mb-2 mx-2"><a class="text-light" href="/view_class/{{$content->id}}">View Content</a></button>
                                    @else
                                        <form action="/add_to_user_content" method="post" class="align-self-end">
                                            @csrf
                                            <input type="hidden" name="type" value="class">
                                            <input type="hidden" name="class" value="{{$content->id}}">
                                            <button type="submit" class="btn btn-primary mt-3 mb-2 mx-2">Sign Me Up!</button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
