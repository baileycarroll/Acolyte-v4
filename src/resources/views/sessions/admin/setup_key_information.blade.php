@extends('layout')
@section('main')
    <header>
        @include("components.sidebar")

        @include("components.navbar")
    </header>
    <main style="margin-top: 58px">
        <div class="container-fluid pt-4 px-5">
            <a href="/setup_keys" class="text-decoration-none text-light">
                <button class="btn btn-primary">Back to All Keys</button>
            </a>
            <div class="card mt-4 text-center">
                <div class="card-header py-3 text-light bg-primary display-6">{{$key->key}}</div>
                <div class="card-body">
                    <form action="/update_setup_key" method="POST">
                        @csrf
                        <div class="row mb-5 mt-3">
                            <div class="col">
                                <input type="hidden" name="key_id" value="{{$key->id}}">
                                <label for="key_name">Key Name:</label>
                                <input type="text" name="key_name" class="form-control mb-2" value="{{$key->key}}" required disabled>
                                <input type="hidden" name="key_name" class="form-control mb-2" value="{{$key->key}}">
                                <label for="key_value">Value:</label>
                                <input type="text" name="key_value" class="form-control" value="{{$key->value}}" required>
                                <label for="old_key_value">Previous Value</label>
                                <input type="text" class="form-control" value="{{$key->old_value}}" disabled>
                                <label for="updated_at">Last Updated:</label>
                                <input type="text" id="updated_at" class="form-control" value="{{$key->updated_at}}" disabled>
                            </div>
                        </div>
                        <button class="btn btn-primary rounded" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
