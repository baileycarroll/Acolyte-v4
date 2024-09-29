@extends('layout')
@section('main')
    <header>
        @include("components.sidebar")

        @include("components.navbar")
    </header>
    <main style="margin-top: 58px">
        <div class="container-fluid pt-4 px-5">
            <a href="/categories" class="text-decoration-none text-light">
                <button class="btn btn-primary">Back to All Categories</button>
            </a>
            <div class="card mt-4 text-center">
                <div class="card-header py-3 text-light bg-primary display-6">{{$category->name}}</div>
                <div class="card-body">
                    <form action="/update_category" method="POST">
                        @csrf
                        <div class="row mb-5 mt-3">
                            <div class="col">
                                <input type="hidden" name="category_id" value="{{$category->id}}">
                                <label for="category_name">Category Name:</label>
                                <input type="text" name="category_name" class="form-control mb-2" value="{{$category->name}}">
                                <label for="updated_at">Last Updated:</label>
                                <input type="text" id="updated_at" class="form-control" value="{{$category->updated_at}}" disabled>
                            </div>
                        </div>
                        <button class="btn btn-primary rounded" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
