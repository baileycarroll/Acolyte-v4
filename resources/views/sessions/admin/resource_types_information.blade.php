@extends('layout')
@section('main')
    <header>
        @include("components.sidebar")

        @include("components.navbar")
    </header>
    <main style="margin-top: 58px">
        <div class="container-fluid pt-4 px-5">
            <a href="/resource_types" class="text-decoration-none text-light">
                <button class="btn btn-primary">Back to All Resource Types</button>
            </a>
            <div class="card mt-4 text-center">
                <div class="card-header py-3 text-light bg-primary display-6">{{$resource_type->name}}</div>
                <div class="card-body">
                    <form action="/update_resource_type" method="POST">
                        @csrf
                        <div class="row mb-5 mt-3">
                            <div class="col">
                                <input type="hidden" name="resource_type_id" value="{{$resource_type->id}}">
                                <label for="resource_type_name">Resource Type Name:</label>
                                <input type="text" name="resource_type_name" class="form-control mb-2" value="{{$resource_type->name}}">
                                <label for="updated_at">Last Updated:</label>
                                <input type="text" id="updated_at" class="form-control" value="{{$resource_type->updated_at}}" disabled>
                            </div>
                        </div>
                        <button class="btn btn-primary rounded" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
