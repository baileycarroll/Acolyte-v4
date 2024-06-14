@extends('layout')
@section('main')
    @include('components.header')
    <link rel="stylesheet" href="{{!! asset('css/fullcalendar.css')}}">
    <div class="container py-2 bg-light fade-from-bt-3s rounded" id="calendar" style="max-height: 45vh;"></div>
    @include('components.footer')
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
