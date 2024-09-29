@extends('layout')
@section('main')
    <header>
        @include("components/sidebar")

        @include("components/navbar")
    </header>
    <main style="margin-top: 58px; margin-bottom: 30px;">
        <div class="container-fluid pt-4 px-5">
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @include("sessions.admin.components.content_editing.course_information")
        </div>
    </main>
    @include("sessions.admin.components.modals.add_module_modal")

@endsection
