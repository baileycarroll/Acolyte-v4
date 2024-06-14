@extends('layout')
@section('main')
    <header>
        @include("components.sidebar")

        @include("components.navbar")
    </header>
    <main style="margin-top: 58px">
        <div class="container-fluid pt-4 px-5">
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <a href="/discussions" class="text-decoration-none text-light">
                <button class="btn btn-primary">Back to All Discussions</button>
            </a>
            <div class="card mt-4 text-center">
                <div class="card-header py-3 text-light bg-primary display-6">{{$discussion->topic}} Discussion</div>
                <div class="card-body">
                    <form action="/update_discussion" method="POST">
                        @csrf
                        <div class="row mb-5 mt-3">
                            <div class="col">
                                <input type="hidden" name="id" value="{{$discussion->id}}">
                                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 g-3">
                                    <div class="col">
                                        <label for="topic">Topic:</label>
                                        <input type="text" name="topic" class="form-control mb-2" value="{{$discussion->topic}}" id="topic">
                                    </div>
                                    <div class="col">
                                        <label for="information">Information:</label>
                                        <textarea class="form-control" name="information" id="information" cols="30" rows="10">{{$discussion->information}}</textarea>
                                    </div>
                                </div>
                                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3 g-3">
                                    <div class="col">
                                        <label for="related_class_1">Related Class</label>
                                        <select name="related_class_1" id="related_class_1" class="select" data-mdb-filter="true" aria-label="select-related_class_1" required>
                                            <option value="{{$discussion->related_class_1}}" selected>Selected: {{App\Models\Classes::find($discussion->related_class_1)->name}}</option>
                                            @foreach($classes as $class)
                                                <option value="{{$class->id}}">{{$class->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="related_module">Related Module</label>
                                        <select name="related_module" id="related_module" class="select" data-mdb-filter="true" aria-label="select-related_module" required>
                                            <option value="{{$discussion->related_module}}" selected>Selected: {{App\Models\Module::find($discussion->related_module)->name}}</option>
                                            @foreach($modules as $module)
                                                <option value="{{$module->id}}">{{$module->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="month">Month Available</label>
                                        <select name="month" id="month" class="form-select" aria-label="select-month" required>
                                            <option value="{{$discussion->month}}" selected>Selected: {{DateTime::createFromFormat('!m', ($discussion->month + 1))->format('F')}}</option>
                                            <option value="0">January</option>
                                            <option value="1">February</option>
                                            <option value="2">March</option>
                                            <option value="3">April</option>
                                            <option value="4">May</option>
                                            <option value="5">June</option>
                                            <option value="6">July</option>
                                            <option value="7">August</option>
                                            <option value="8">September</option>
                                            <option value="9">October</option>
                                            <option value="10">November</option>
                                            <option value="11">December</option>
                                        </select>
                                    </div>
                                </div>
                                <label for="updated_at">Last Updated:</label>
                                <input type="text" id="updated_at" class="form-control" value="{{$discussion->updated_at}}" disabled>
                                <button type="submit" class="btn btn-primary rounded w-25 text-center mt-4">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
