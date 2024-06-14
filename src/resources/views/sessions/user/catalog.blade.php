@extends('layout')
@section('main')
    <header>
        @include("components/sidebar")

        @include("components/navbar")
    </header>
    <main style="margin-top: 58px">
        <div class="container-fluid pt-4 px-5">
            <div class="row mt-4">
                <h2 class="text-center text-light mb-4">Content Catalog</h2>
                @if($spotlight_course != NULL || $spotlight_class != NULL)
                    <div class="col-sm-12 col-md-2 col-lg-3 mx-auto">
                        <div class="nav flex-column nav-pills text-center" id="catalog_tab_pills" role="tablist" aria-orientation="vertical">
                            <a href="#catalog_home" class="nav-link active" id="catalog_home_tab" data-mdb-toggle="pill" role="tab" aria-controls="catalog_home" aria-selected="true">Home</a>
                            <a href="#catalog_courses" class="nav-link" id="catalog_courses_tab" data-mdb-toggle="pill" role="tab" aria-controls="catalog_courses" aria-selected="true">Courses</a>
                            <a href="#catalog_classes" class="nav-link" id="catalog_classes_tab" data-mdb-toggle="pill" role="tab" aria-controls="catalog_classes" aria-selected="true">Classes</a>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-10 col-lg-9">
                        <div class="tab-content" id="catalog_content">
                            <div class="tab-pane fade show active" id="catalog_home" role="tabpanel" aria-labelledby="catalog_home_tab">
                                @if($spotlight_course != NULL)
                                    @include("sessions.user.components.spotlight_course")
                                @endif
                                @if($spotlight_class != NULL)
                                    @include("sessions.user.components.spotlight_classes")
                                @endif
                            </div>
                            <div class="tab-pane fade" id="catalog_courses" role="tabpanel" aria-labelledby="catalog_courses_tab">
                                @include("sessions.user.components.course_catalog")
                            </div>
                            <div class="tab-pane fade" id="catalog_classes" role="tabpanel" aria-labelledby="catalog_classes_tab">
                                @include("sessions.user.components.class_catalog")
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-sm-12 col-md-2 col-lg-3 mx-auto">
                        <div class="nav flex-column nav-pills text-center" id="catalog_tab_pills" role="tablist" aria-orientation="vertical">
                            <a href="#catalog_courses" class="nav-link active" id="catalog_courses_tab" data-mdb-toggle="pill" role="tab" aria-controls="catalog_courses" aria-selected="true">Courses</a>
                            <a href="#catalog_classes" class="nav-link" id="catalog_classes_tab" data-mdb-toggle="pill" role="tab" aria-controls="catalog_classes" aria-selected="true">Classes</a>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-10 col-lg-9">
                        <div class="tab-content" id="catalog_content">
                            <div class="tab-pane fade show active" id="catalog_courses" role="tabpanel" aria-labelledby="catalog_courses_tab">
                                @include("sessions.user.components.course_catalog")
                            </div>
                            <div class="tab-pane fade" id="catalog_classes" role="tabpanel" aria-labelledby="catalog_classes_tab">
                                @include("sessions.user.components.class_catalog")
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
