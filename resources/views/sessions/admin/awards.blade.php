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
            @include("sessions.admin.components.awards_table")
        </div>
    </main>

    @can('CreateSystem')
        @include("sessions.admin.components.modals.add_award_modal")
    @endcan
@endsection
