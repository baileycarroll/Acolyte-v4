@extends('layout')
@section('main')

    <!--Main layout-->
    <main style="padding-left: 0; height: 100vh;">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="container-fluid h-100 py-4 mx-auto d-flex align-items-center justify-content-center">
            <div class="card">
                <div class="card-body p-5 shadow-5 text-center">
                    <h2 class="fw-bold mb-5">Log into <span class="text-primary">Acolyte R.E.A.L.M.S.</span></h2>
                    <form action="/login" method="POST">
                        @csrf
                        @error('username')
                        <p class="text-danger mt-2">{{$message}}</p>
                        @enderror
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
                        <!-- Submit button -->
                        <button
                            type="submit"
                            class="btn btn-primary btn-block mb-4"
                        >
                            Log In
                        </button>
                        <p class="mt-3"><small>Don't have an account? <a href="/register">Register</a></small></p>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!--Main layout-->
@endsection
