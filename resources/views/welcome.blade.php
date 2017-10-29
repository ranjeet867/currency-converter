<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container text-center">
            <div class="row">
                <div class="well center-block" style="max-width:400px">
                    <a href="{{ url('/sign-in') }}"><button type="button" class="btn btn-primary btn-lg btn-block">Sign In</button></a>
                </div>

            </div>
        </div>
    </body>
</html>
