@extends('layout')
@section('main')
@include('components.header')
<div class="main">
    <div class="container mt-5 py-5">
        <div class="card">
            <div class="card-header bg-primary text-light">
                <h1 class="text-center">Terms of Service</h1>
            </div>
            <div class="card-body text-center">
                <p class="text-center">
                    <iframe class="w-100" style="height: 75vh;" src="{{url('terms_of_service.pdf')}}" frameborder="0"></iframe>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
