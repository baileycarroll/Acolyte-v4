@extends('layout')
@section('main')
<!-- @include('custom_front_ends.header') -->
    @php
        $demoAccounts = [
            ['username' => 'jharper-admin', 'label' => 'Administrator'],
            ['username' => 'morgan.lee', 'label' => 'Instructor'],
            ['username' => 'sam.rivera', 'label' => 'User'],
        ];
    @endphp
    <!--Main layout-->
    <main class="bg-image-main" style="padding-left: 0; height: 100vh;">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="container-fluid h-100 py-4 mx-auto d-flex align-items-center justify-content-center">
            <div class="row justify-content-center g-4 w-100">
                <div class="col-12 col-lg-5 col-xl-4">
                    <div class="card h-100">
                        <div class="card-body p-5 shadow-5 text-center">
                            <h2 class="fw-bold mb-5">Log into <span class="text-primary">{{\App\Models\SetupKeys::where('key', '=', 'instance_name')->first()->value}}</span></h2>
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
                                {{-- <p class="mt-3"><small>Don't have an account? <a href="/register">Register</a></small></p>
                                <p class="mt-3">
                                    <small>
                                        By proceeding you agree to our
                                        <a href="/terms" target="_blank">Terms of Service</a>, our
                                        <a href="/privacy" target="_blank">Privacy Policy</a>,
                                        and utilization of cookies.
                                    </small>
                                </p> --}}
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5 col-xl-4">
                    <div class="card h-100">
                        <div class="card-body p-5 shadow-5">
                            <h3 class="fw-bold mb-3 text-center">Demo Accounts</h3>
                            <p class="text-muted text-center mb-4">
                                Use any of these demo logins.
                            </p>
                            <div class="border rounded px-3 py-2 mb-4 bg-light">
                                <div class="small text-uppercase text-muted">Shared Password</div>
                                <div class="fw-semibold">DemoPass123!</div>
                            </div>
                            <div class="d-flex flex-column gap-3">
                                @foreach($demoAccounts as $account)
                                    <div class="border rounded px-3 py-2">
                                        <div class="fw-semibold">{{ $account['username'] }}</div>
                                        <div class="text-muted small">{{ $account['label'] }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--Main layout-->
@endsection
