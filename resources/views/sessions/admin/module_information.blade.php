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

            @include("sessions.admin.components.content_editing.module_information")
        </div>
    </main>
    @include("sessions.admin.components.modals.upload_module_content_modal")
    @include("sessions.admin.components.modals.create_module_quiz_modal")

@endsection
