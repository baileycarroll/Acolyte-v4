@extends('layout')
@section('main')
    @include('components.header')
    <div class="d-flex justify-content-center">
        <div class="text-center bg-jumbo-intro rounded text-light fade-from-bt-2s align-self-center">
            <div class="col-md-5 p-lg-5 mx-auto my-5">
                <h1 class="display-4 fw-normal">un-Traditional Magick</h1>
                <p class="lead fw-normal">Welcome to un-Traditional Magick! We are a group of practitioners from various paths and faiths who have come together to provide a safe space to learn. </p>
                <a class="btn btn-outline-light" href="/about_us" data-mdb-ripple-color="light">Learn More!</a>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center d-none d-md-block">
        <div class="container align-self-center">
            <div class="row row-cols-1 row-cols-lg-3 g-4 p-3 p-md-5 mx-auto">
                <div class="col">
                    <div class="circle-card circle-bg_staff text-light text-center p-3 fade-from-lt-2s">
                        <div class="circle-card_text">Our staff are committed to providing a safe and inclusive space for all. <br /><a class="btn btn-outline-light " data-mdb-ripple-color="light" href="/about_us">About Us</a></div>
                    </div>
                </div>
                <div class="col">
                    <div class="circle-card circle-bg_event text-light text-center p-3 fade-from-tp-2s">
                        <div class="circle-card_text">We have events and classes every week discussion a variety of topics.<br /><a class="btn btn-outline-light" data-mdb-ripple-color="light" href="/our_events">Events & Classes</a></div>
                    </div>
                </div>
                <div class="col">
                    <div class="circle-card circle-bg_blog text-light text-center p-3 fade-from-rt-2s">
                        <div class="circle-card_text">We love to discuss and write about subjects our students and staff care about.<br /><a class="btn btn-outline-light d-none" data-mdb-ripple-color="light" href="/blog">Our Blog</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.footer')
@endsection
