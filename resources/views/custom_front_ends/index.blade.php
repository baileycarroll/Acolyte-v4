@extends('layout')
@section('main')
    @include('custom_front_ends.header')
        <section>
            <div class="vh-100 bg-image-main">
                <div class="mask" style="background-color: rgba(250, 182, 162, 0.15);">
                    <div class="container d-flex justify-content-start align-items-center h-100 mt-4 rounded fade-from-bt-2s5">
                        <div class="row">
                            <div class="col-lg-10 mask-custom p-3">
                                <h1 class="display-4 text-uppercase" style="letter-spacing: 3px;">un-Traditional Magick</h1>
                                <p class="lead mb-4 text-dark">
                                    We are a group of practitioners from various paths and faiths who have come together to provide a safe space to learn magick, un-traditionally.
                                </p>
                                <a href="/login"><button type="button" class="btn btn-white text-primary btn-rounded btn-lg mb-3 d-none">Get started</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
