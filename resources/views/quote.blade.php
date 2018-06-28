@extends('layouts.app', ['title' => 'Free Quote'])

@push('googlemaps')
<script src="{{ config('services.google.places.uri') }}?key={{ config('services.google.places.key') }}&libraries=places" async defer></script>
@endpush

@section('body')
    <div>
        <div class="m-6 md:m-0">
            <h2 class="text-center my-8">Thank you for your interest in hiring {{ config('company.name') }}!</h2>
            <p class="text-lg max-w-lg mx-auto text-center mb-16">
                For a customized proposal for your event, please fill out the quote below. Once the quote is submitted, we will respond to you within the next business day.
            </p>
        </div>
        <div class="flex flex-col md:flex-row bg-grey-lighter">
            <div class="hidden md:block lg:w-1/3 xl:w-1/2">
                <img src="{{ asset('img/territory-map.png') }}" class="w-full">
            </div>
            <div id="quote-container" class="w-full lg:w-2/3 xl:w-1/2 py-8 px-6 md:px-16">
                    <app-quote></app-quote>
            </div>
        </div>
    </div>
@endsection
