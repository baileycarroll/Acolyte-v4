@extends('layout')
@section('main')
    <script src="{!! asset('js/app.js') !!}"></script>
    <link rel="stylesheet" href="{!! asset('css/quill.core.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/quill.snow.css') !!}">

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
                                    <input type="hidden" id="body" name="body">
                                    <div id="editor" class="mb-3 fs-4"></div>
                                    <button type="submit" class="btn btn-primary rounded">Send Email!</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </main>
    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        let toolbarOptions = [['bold', 'italic', 'underline'], ['link', 'image']];
        let options = {
            modules: {
                toolbar: true
            },
            theme: 'snow'
        };
        let container = document.getElementById('editor');
        let quill = new Quill(container, options);

        document.getElementById('contact-form').addEventListener('submit', (e) => {
            e.preventDefault();
            document.getElementById('body').value = quill.root.innerHTML
            document.getElementById('contact-form').submit()
        })
    </script>
@endsection
