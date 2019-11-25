@extends('layouts.admin')
@section('content')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Booking</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        <!-- Styles 
        <style>
        </style>
        -->
        <link href="{{ asset('packages/core/main.css') }}" rel='stylesheet' />
    <link href="{{ asset('packages/daygrid/main.css') }}" rel='stylesheet' />

    <script src="{{ asset('packages/core/main.js') }}"></script>
    <script src="{{ asset('packages/daygrid/main.js') }}"></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          plugins: [ 'dayGrid' ]
        });

        calendar.render();
      });

    </script>
    </head>
    <body>
        <!--<div class="flex-center position-ref full-height">
            

            <div class="content">
                <div class="title m-b-md">
                    Booking
                </div>

                
            </div>
        </div>-->
        <div id='calendar'></div>
        
    </body>
</html>

@endsection
@section('scripts')
@parent

@endsection