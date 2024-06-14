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
            <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3">
                <div class="col-sm-12 col-md-4 col-lg-6">
                    <div class="card mt-4">
                        <div class="card-header bg-primary py-2">
                            <h2 class="text-center text-light my-4">Welcome to {{$instance_name}}!</h2>
                        </div>
                        <div class="card-body">
                            <h3 class="text-primary text-center mb-2">Upcoming Classes & Events</h3>
                            <section id="eventCalendar" name="Event Calendar">
                                <div id="calendar"></div>
                            </section>
                        </div>
                    </div>
                </div>
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
