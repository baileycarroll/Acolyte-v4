@extends('layout')
@section('main')
    @include('components.header')
    <!--Main layout-->
    <main class="bg-image-main" style="padding-left: 0; height: 100vh;">
        <div class="container-fluid h-100 py-4 mx-auto d-flex align-items-center justify-content-center">
            <div class="card">
                <div class="card-body p-5 shadow-5 text-center">
                    <h2 class="fw-bold mb-5">Register with <span class="text-primary">{{\App\Models\SetupKeys::where('key', '=', 'instance_name')->first()->value}}</span></h2>
                    <form action="/register" method="POST">
                        @csrf
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input
                                        type="text"
                                        id="first_name"
                                        name="first_name"
                                        class="form-control"
                                        value="{{old('first_name')}}"
                                        required
                                    />
                                    <label class="form-label" for="first_name"
                                    >First name</label
                                    >
                                </div>
                                @error('first_name')
                                <p class="text-danger mt-2">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input
                                        type="text"
                                        id="last_name"
                                        name="last_name"
                                        class="form-control"
                                        value="{{old('last_name')}}"
                                        required
                                    />
                                    <label class="form-label" for="last_name"
                                    >Last name</label
                                    >
                                </div>
                                @error('last_name')
                                <p class="text-danger mt-2">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <!-- Username Input -->
                        <div class="form-outline mb-4">
                            <input
                                type="text"
                                id="username"
                                name="username"
                                class="form-control"
                                value="{{old('username')}}"
                                required
                            >
                            <label for="username" class="form-label">Username</label>
                        </div>
                        @error('username')
                        <p class="text-danger mt-2">{{$message}}</p>
                        @enderror
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control"
                                value="{{old('email')}}"
                                required
                            />
                            <label class="form-label" for="email"
                            >Email address</label
                            >
                        </div>
                        @error('email')
                        <p class="text-danger mt-2">{{$message}}</p>
                        @enderror
                        <div class="form-outline mb-4">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                            />
                            <label class="form-label" for="password">
                                Password
                            </label>
                        </div>
                        @error('password')
                        <p class="text-danger text-sm mt-2 ">{{$message}}</p>
                        @enderror
                        <!-- Submit button -->
                        <button
                            type="submit"
                            class="btn btn-primary btn-block mb-4"
                        >
                            Sign up
                        </button>
                        <p class="mt-3"><small>Already have an account? <a href="/login">Login</a></small></p>
                        <p class="mt-3">
                            <small>
                                By proceeding you agree to our
                                <a href="/terms" target="_blank">Terms of Service</a>, our
                                <a href="/privacy" target="_blank">Privacy Policy</a>,
                                and utilization of cookies.
                            </small>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!--Main layout-->
@endsection
