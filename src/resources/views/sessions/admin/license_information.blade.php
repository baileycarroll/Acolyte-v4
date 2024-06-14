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
                <div class="card-body text-center">
                    <form action="/update_license" method="POST">
                        @csrf
                        <div class="row mb-5 mt-3">
                            <div class="col">
                                <input type="hidden" name="license_id" value="{{$license->id}}">
                                <div class="row">
                                    <div class="col">
                                        <label for="license_name">License Name:</label>
                                        <input type="text" name="license_name" class="form-control mb-2" value="{{$license->name}}">
                                        <label for="license_description">Description:</label>
                                        <textarea name="license_description" id="license_description" cols="30" rows="10" class="form-control">{{$license->description}}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <label for="license_price">Price:</label>
                                                <div class="input-group flex-nowrap">
                                                    <span class="input-group-text border-0">$</span>
                                                    <input type="number" name="license_price" class="form-control rounded mb-2" value="{{$license->price}}">
                                                    <span class="input-group-text border-0">USD</span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="stripe_api_id">Stripe API ID:</label>
                                                <input type="text" name="stripe_api_id" id="stripe_api_id" class="form-control rounded mb-2" value="{{$license->stripe_api_id}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-check form-switch">
                                                    @if($license->admin === 1)
                                                        <input type="checkbox" name='license_admin' id="license_admin" class="form-check-input" role="switch" checked />
                                                        <label for="license_admin" class="form-check-label">Admin License?</label>
                                                    @else
                                                        <input type="checkbox" name='license_admin' id="license_admin" class="form-check-input" role="switch" />
                                                        <label for="license_admin" class="form-check-label">Admin License?</label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-check form-switch">
                                                    @if($license->trial === 1)
                                                        <input type="checkbox" name='license_trial' id="license_trial" class="form-check-input" role="switch" checked />
                                                        <label for="license_trial" class="form-check-label">Trial License?</label>
                                                    @else
                                                        <input type="checkbox" name='license_trial' id="license_trial" class="form-check-input" role="switch" />
                                                        <label for="license_trial" class="form-check-label">Trial License?</label>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="updated_at">Last Updated:</label>
                                        <input type="text" id="updated_at" class="form-control" value="{{$license->updated_at}}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary rounded" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
