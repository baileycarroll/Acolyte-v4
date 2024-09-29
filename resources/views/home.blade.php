@extends('layout')
@section('main')

    <header>
        @include("components/sidebar")

        @include("components/navbar")
    </header>
    <link rel="stylesheet" href="{{!! asset('css/fullcalendar.css')}}">
    <!--Main layout-->
    <main style="margin-top: 58px">
        <div class="container-fluid pt-4 px-5">
            @if(session('status'))
                <div class="alert alert-success my-3">
                    {{ session('status') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger my-3">
                    {{ session('error') }}
                </div>
            @endif
        <div class="container-fluid pt-4 px-5">
            <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-1 row-cols-xl-2 row-cols-xxl-3">
                @if(\App\Models\User::find(Auth::id())->user_status != 'Active')
                    <div class="col">
                        <div class="card mt-4">
                            <div class="card-header bg-primary py-2">
                                <h2 class="text-center text-light my-4">NOTICE!</h2>
                            </div>
                            <div class="card-body">
                                <p class="text-center">Your Account is not active, if you believe this to be in error please contact support.</p>

                                <p class="text-primary text-center"><a href="mailto:{{\App\Models\SetupKeys::where('key', '=', 'Support_Email')->first()->value}}">{{\App\Models\SetupKeys::where('key', '=', 'Support_Email')->first()->value}}</a></p>
                            </div>
                        </div>
                    </div>
                @elseif(!(\App\Models\User::find(Auth::id())->subscribed('acolyte')) && (\App\Models\SetupKeys::where('key', '=', 'use_subscriptions')->first()->value == 1))
                    <div class="col">
                        <div class="card mt-4">
                            <div class="card-header bg-primary py-2">
                                <h2 class="text-center text-light my-4">NOTICE!</h2>
                            </div>
                            <div class="card-body">
                                <p class="text-center">Your subscription is not active, please navigate to your profile and manage you're subscription to regain access. If you believe this to be in error please contact support.</p>

                                <p class="text-primary text-center"><a href="mailto:{{\App\Models\SetupKeys::where('key', '=', 'Support_Email')->first()->value}}">{{\App\Models\SetupKeys::where('key', '=', 'Support_Email')->first()->value}}</a></p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col">
                        <div class="card mt-4">
                            <div class="card-header bg-primary py-2">
                                <h2 class="text-center text-light my-4">Welcome to {{$instance_name}}!</h2>
                            </div>
                            <div class="card-body">
                                <h3 class="text-primary text-center mb-2">Upcoming Classes & Events</h3>
                                <section id="eventCalendar">
                                    <div id="calendar"></div>
                                </section>
                            </div>
                        </div>
                    </div>
                    @if($discussion)
                        <div class="col">
                            <div class="card mt-4">
                                <div class="card-header bg-primary py-2">
                                    <h2 class="text-center text-light my-4">This Months Discussion!</h2>
                                </div>
                                <div class="card-body">
                                    @if($discussion != NULL ?? false)
                                        <h3 class="text-primary text-center mb-2">{{$discussion->topic}}</h3>
                                        <p class="text-center">{{$discussion->information}}</p>
                                    @else
                                        <p class="text-center">No topic set for this month yet!</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendar');
            let calendar = new Calendar(calendarEl, {
                plugins: [dayGridPlugin, listPlugin, googleCalendarPlugin],
                themeSystem: 'bootstrap5',
                googleCalendarApiKey: '{{ config('app.GOOGLE_CALENDAR_API_KEY', '') }}',
                initialView: 'listMonth',
                headerToolbar: {
                    left: '',
                    center: 'title',
                    right:'',
                },
                events: {
                    googleCalendarId: 'c_afnjhbmg83g33pvn21rgcbc4mk@group.calendar.google.com'
                }
            });
            calendar.render()
        });
    </script>
@endsection
