@extends('layouts.app', ['title' => 'Free Quote'])

@push('googlemaps')
<script src="{{ config('services.google.places.uri') }}?key={{ config('services.google.places.key') }}&libraries=places" async defer></script>
@endpush

@section('body')
    <div>
        <h2 class="text-center my-8">Thank you for your interest in hiring {{ config('company.name') }}!</h2>
        <p class="text-lg max-w-lg mx-auto text-center mb-16">For a customized proposal for your event, please fill out the quote below. Once the quote is submitted, we will respond to you within the next business day.</p>
        <div class="flex flex-col md:flex-row">
            <div class="w-full md:w-2/5">
                <img src="{{ asset('img/territory-map.png') }}" class="w-full">
            </div>
            <div class="w-full md:w-3/5 bg-grey-lighter py-8 px-16">
                    <app-quote></app-quote>
            </div>
        </div>
    </div>
@endsection
