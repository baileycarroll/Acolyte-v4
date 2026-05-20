@extends('layout')
@section('main')
    <header>
        @include("components.sidebar")

        @include("components.navbar")
    </header>
    <main style="margin-top: 58px">
        <div class="container-fluid pt-4 px-5">
            <a href="/departments" class="text-decoration-none text-light">
                <button class="btn btn-primary">Back to All Departments</button>
            </a>
            <div class="card mt-4 text-center">
                <div class="card-header py-3 text-light bg-primary display-6">{{$department->name}}</div>
                <div class="card-body">
                    <form action="/update_department" method="POST">
                        @csrf
                        <div class="row mb-5 mt-3">
                            <div class="col">
                                <input type="hidden" name="department_id" value="{{$department->id}}">
                                <label for="department_name">Department Name:</label>
                                <input type="text" name="department_name" class="form-control mb-2" value="{{$department->name}}">
                                <label for="updated_at">Last Updated:</label>
                                <input type="text" id="updated_at" class="form-control" value="{{$department->updated_at}}" disabled>
                            </div>
                        </div>
                        <button class="btn btn-primary rounded" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
