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
        @stack('googlemaps')
        @stack('payments')
        @stack('pdf')
        <title>{{ config('company.name', 'Laravel') }}</title>
    </head>
    <body class="font-sans antialiased bg-grey-lightest text-grey-darkest leading-normal">
        <div id="app">
            @include('layouts.partials._header')

            @isset($title)
                <div class="bg-black py-6 md:py-8 border-b border-grey-lighter carbonfiber">
                    <h1
                        class="flex justify-center text-grey-light text-center text-2xl md:text-4xl"
                    >
                        @isset($icon)
                            <div class="fill-current text-green mr-6">
                                @svg($icon, 'h-16')
                            </div>
                        @endisset
                        <div>
                            {{ $title }}
                        </div>
                    </h1>
                </div>
            @endisset

            @yield('body')

            <flash-message transition-name="fade"></flash-message>

            @include('layouts.partials._footer')
        </div>
    </body>
</html>
