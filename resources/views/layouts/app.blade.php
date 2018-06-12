<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display|Raleway">
        <script src="{{ mix('js/app.js') }}" defer></script>
        <title>{{ config('company.name', 'Laravel') }}</title>
    </head>
    <body class="font-sans antialiased text-grey-darkest leading-tight">
        <div id="app">
            @include('layouts.partials._header')
            @yield('body')
            @include('layouts.partials._footer')
        </div>
    </body>
</html>
