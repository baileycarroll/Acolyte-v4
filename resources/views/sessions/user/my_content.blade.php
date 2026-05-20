@extends('layout')
@section('main')
    <header>
        @include("components/sidebar")

        @include("components/navbar")
    </header>
    <main style="margin-top: 58px">
        <div class="container-fluid pt-4 px-5">
            <div class="row mt-4">
                <h2 class="text-center text-light mb-4">My Content Catalog</h2>
                <div class="col-sm-12 col-md-2 col-lg-3 mx-auto">
                    <div class="nav flex-column nav-pills text-center" id="catalog_tab_pills" role="tablist" aria-orientation="vertical">
                        <a href="#catalog_courses" class="nav-link active" id="catalog_courses_tab" data-mdb-toggle="pill" role="tab" aria-controls="catalog_courses" aria-selected="true">Courses</a>
                        <a href="#catalog_classes" class="nav-link" id="catalog_classes_tab" data-mdb-toggle="pill" role="tab" aria-controls="catalog_classes" aria-selected="true">Classes</a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-10 col-lg-9">
                    <div class="tab-content" id="catalog_content">
                        <div class="tab-pane fade show active" id="catalog_courses" role="tabpanel" aria-labelledby="catalog_courses_tab">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    <h3 class="text-center text-white">Available Courses</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row row-cols-md-3 row-cols-sm-2 row-cols-xs-1 g-4">
                                        @foreach($courses as $course)
                                            @if(App\Models\User_Content::where('user', '=', \Illuminate\Support\Facades\Auth::id())->where('course', '=', $course->id)->get()->isNotEmpty())
                                                @if(App\Models\Course::where('status', '=', 'Active')->where('id', '=', $course->id)->get()->isNotEmpty())
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
                                                            <button class="btn btn-primary align-self-end mt-3 mb-2 mx-2"><a class="text-light" href="/view_course/{{$course->id}}">View Content</a></button>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="catalog_classes" role="tabpanel" aria-labelledby="catalog_classes_tab">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    <h3 class="text-center text-white">Available Classes</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row row-cols-md-3 row-cols-sm-2 row-cols-xs-1 g-4">
                                        @foreach($classes as $class)
                                            @if(App\Models\User_Content::where('user', '=', \Illuminate\Support\Facades\Auth::id())->where('class', '=', $class->id)->get()->isNotEmpty())
                                                @if(App\Models\Classes::where('status', '=', 'Active')->where('id', '=', $class->id)->get()->isNotEmpty())
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
                                                            <button class="btn btn-primary align-self-end mt-3 mb-2 mx-2"><a class="text-light" href="/view_class/{{$class->id}}">View Content</a></button>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
