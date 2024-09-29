@extends('layout')
@section('main')
    @include('custom_front_ends.header')
    <link rel="stylesheet" href="{{!! asset('css/fullcalendar.css')}}">
    <section>
        <div class="vh-100 bg-image-main bg-image d-flex justify-content-center align-items-start">
            <div class="container mt-5">
                <div class="row d-flex align-items-center h-100 mt-5 pt-5">
                    <div class="col text-center text-primary mask-custom rounded p-5 fade-from-bt-3s">
                        <h2 class="display-2 text-light mb-4">Our Upcoming Events & Live Classes</h2>
                        <div class="container py-2 bg-light fade-from-bt-3s  border-0 rounded" id="calendar" style="max-height: 65vh;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
