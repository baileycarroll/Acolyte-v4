@extends('layout')
@section('main')
    <header>
        @include("components.sidebar")

        @include("components.navbar")
    </header>
    <main style="margin-top: 58px">
        <div class="container-fluid pt-4 px-5">
            <a href="/licenses" class="text-decoration-none text-light">
                <button class="btn btn-primary">Back to All Licenses</button>
            </a>
            <div class="card mt-4 text-center">
                <div class="card-header py-3 text-light bg-primary display-6">{{$license->name}}</div>
                <div class="card-body">
                    <form action="/update_license" method="POST">
                        @csrf
                        <div class="row mb-5 mt-3">
                            <div class="col">
                                <input type="hidden" name="license_id" value="{{$license->id}}">
                                <label for="license_name">License Name:</label>
                                <input type="text" name="license_name" class="form-control mb-2" value="{{$license->name}}" disabled>
                                <label for="license_description">Description:</label>
                                <textarea name="license_description" id="license_description" cols="30" rows="10" class="form-control" disabled>{{$license->description}}</textarea>
                                <label for="license_price">Price:</label>
                                <input type="number" name="license_price" class="form-control mb-2" value="{{$license->price}}" disabled>
                                <label for="stripe_api_id">Stripe API ID:</label>
                                <input type="number" name="stripe_api_id" id="stripe_api_id" class="form-control rounded mb-2" value="{{$license->stripe_api_id}}" disabled>
                                <label for="updated_at">Last Updated:</label>
                                <input type="text" id="updated_at" class="form-control" value="{{$license->updated_at}}" disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
