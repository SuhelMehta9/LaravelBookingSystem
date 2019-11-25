<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Booking</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #a8a8a8;
                color: #ffffff;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                
            }

            .title {
                font-weight: 800;
                font-size: 160px;
            }

            .links > a {
                color: #ffffff;
                padding: 20px 40px;
                font-size: 28px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            
            
            .m-b-md {
                margin-bottom: 15px;
                font-size: 56px;
                font-weight: 600;
            }
            
            
        </style>
    </head>
    <body background="{{ asset('image/1.1-0-dark1.jpg') }}">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content container-fluid">
                <div class="title" >
                    Booking
                </div>
                <div class="m-b-md">
                    of<br>
                    Seminar Hall <br>
                    Click here to Book Hall
                    
                </div>
                <!--<div>
                <a href="#" class="btn btn-info" role="button">Link Button</a>
                </div>-->
                <div class="links">
                <a href="{{ route('admin.bookings.create') }}" class="btn btn-info" role="button" >Book Hall</a>
                    <!--<a href="https://laravel.com/docs" data-toogle= "tooltip" title="To know about laravel click here">Laravel</a>
                    <a href="https://github.com/SuhelMehta9/LaravelBookingSystem"data-toogle= "tooltip" title="To get the code of website click here"> GitHub</a>-->
                </div>
            </div>
        </div>
        
    </body>
</html>
