@extends('layout')
@section('main')
    @include('components.header')
    <section id="aboutIntroduction" name="About Us - Introduction">
        <div class="container px-5 py-4">
            <h2 class="pb-2 border-bottom text-light">About un-Traditional Magick</h2>
            <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
                <div class="col fade-from-lt-2s">
                    <div class="card card-cover h-100 overflow-hidden text-white bg-violets rounded-5 shadow-lg">
                        <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                            <p>Founded in May 2019, un-Traditional Magick has been working to provide a safe inclusive space to learn for all people, regardless of faith, creed, tradition, identity or any other protected class. un-Traditional Magick accepts all who wish to learn and grow with a community.</p>
                        </div>
                    </div>
                </div>
                <div class="col fade-from-bt-2s">
                    <div class="card card-cover h-100 overflow-hidden text-white bg-chrisanths rounded-5 shadow-lg">
                        <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                            <p>Our Chancellor can often be quoted saying: "If it is not fun, you are doing it wrong!" And this cannot be any more true to our mission and cause. Magick is supposed to be fun, and is an integral part of everyone's being. This is a fundamental part of our beliefs and we hold to this everyday.</p>
                        </div>
                    </div>
                </div>
                <div class="col fade-from-rt-2s">
                    <div class="card card-cover h-100 overflow-hidden text-white bg-snapdragon rounded-5 shadow-lg">
                        <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                            <p>Our goal is to provide the safe space to learn because there has always been some stigma about learning other cultures and religions. We have provided this space because of rather dear members in the past who have expressed concerned with being publicly "outed" and we respect this.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="detailedAbout" class="mb-3" name="Detailed About Us Information">
        <div class="container bg-secondary rounded shadow-lg text-white fade-from-bt-2s5">
            <div class="col p-2">
                <h1 class="display-6 fst-italic">What we do in more detail...</h1>
                <p>
                    We provide a learning platform for content creators to be able to provide and teach their studies, courses, and content from around the globe. We built this platform before the 2020 Pandemic and have found a lot of use from it. Some of our groups have been able to keep meeting via google meets and zoom and be able to not lose a beat in the process. Now we would like to make this platform available to the rest of the world.</p>

                <p>un-Traditional Magick is based on the idea that everyone has their own path to follow and everyone practices their own beliefs differently. What we aim to do is to guide those on their personal paths to understand themselves in a way they have not before. We teach a variety of Magickal Subjects from traditions from all around the world. We do not hold ourselves to any tradition or way of thought and accept any and all who have good in their hearts and minds. Whatever belief they may follow.
                </p>
            </div>
        </div>
    </section>
    @include('components.footer')
@endsection
