<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
      <input type="hidden" id="baseurl" value="{{ url('/') }}">

      <div class="container m-t-20 m-b-20">
        <h3>Booking Application</h3>
      </div>

      <section id="app"></section>

      <script src="{{ asset('js/app.js') }}" charset="utf-8"></script>
    </body>
</html>
