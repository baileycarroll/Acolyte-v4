@extends('layout')
@section('main')
    <header>
        @include("components/sidebar")

        @include("components/navbar")
    </header>
    <main style="margin-top: 58px">
        <div class="container-fluid pt-4 px-5">
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
                <div class="card mt-4">
                    <div class="card-header bg-primary">
                        <h1 class="text-light text-center">Contact User: {{$contact->first_name}} {{$contact->last_name}}</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <form action="#" method="post" id="contact-form">
                                    @csrf
                                    <input type="hidden" name="contact" value="{{$contact->email}}">
                                    <div class="form-outline mb-3">
                                        <input type="text" name="subject" id="subject" class="form-control">
                                        <label for="subject" class="form-label">Subject</label>
                                    </div>
                                    <input type="hidden" name="author" value="{{\App\Models\User::find(Auth::id())->first_name}} {{\App\Models\User::find(Auth::id())->last_name}}">
                                    <div class="form-outline mb-3">
                                        <textarea name="body" id="body" class="form-control" rows="10"></textarea>
                                        <label for="body" class="form-label">Message</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary rounded">Send Email!</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </main>
@endsection
