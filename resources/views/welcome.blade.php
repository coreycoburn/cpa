@extends('layouts.app')

@section('body')
    <carousel
        class="hidden sm:flex sm:flex-col"
        :autoplay="true"
        :autoplay-hover-pause="true"
        :per-page=1
        :scroll-per-page="true"
        pagination-active-color="#CC1F1A"
        pagination-color="#B8C2CC"
    >
        <slide class="bg-cover h-112" style="background-image: url('/img/slider/image01.jpg')">
            <div class="flex flex-col">
                <div class="flex max-w-lg mt-16 mb-8 mx-auto py-8">
                    <h3 class="text-4xl uppercase leading-loose text-center text-white">
                        {{ config('company.slogan') }}!
                    </h3>
                </div>
                <div class="flex justify-center">
                    <a
                        href="{{ route('quote') }}"
                        class="bg-green z-20 no-underline hover:bg-green-dark text-white uppercase tracking-wide text-3xl font-bold py-4 px-8 border border-green-darker rounded"
                    >
                      Free Quote
                    </a>
                </div>
            </div>
        </slide>
        <slide class="bg-cover h-112" style="background-image: url('/img/slider/image02.jpg')"></slide>
        <slide class="bg-cover h-112" style="background-image: url('/img/slider/image03.jpg')"></slide>
        <slide class="bg-cover h-112" style="background-image: url('/img/slider/image04.jpg')"></slide>
        <slide class="bg-cover h-112" style="background-image: url('/img/slider/image05.jpg')"></slide>
        <slide class="bg-cover h-112" style="background-image: url('/img/slider/image06.jpg')"></slide>
        <slide class="bg-cover h-112" style="background-image: url('/img/slider/image07.jpg')"></slide>
        <slide class="bg-cover h-112" style="background-image: url('/img/slider/image08.jpg')"></slide>
        <slide class="bg-cover h-112" style="background-image: url('/img/slider/image09.jpg')"></slide>
        <slide class="bg-cover h-112" style="background-image: url('/img/slider/image10.jpg')"></slide>
        <slide class="bg-cover h-112" style="background-image: url('/img/slider/image11.jpg')"></slide>
        <slide class="bg-cover h-112" style="background-image: url('/img/slider/image12.jpg')"></slide>
    </carousel>

    <div class="container mx-auto mt-8 sm:mt-16">
        <h2 class="mb-6 text-center text-3xl">Premier Parking & Shuttle Service</h2>
        <div class="flex flex-col max-w-lg mt-8 mb-16 mx-auto">
            <p class="flex-1 px-16 mb-8 leading-loose">
                CPA Valet is "The Premier Parking and Shuttle" company servicing the Bay Area. As a company, we simply strive to be <em>outstanding</em> by creating raving fan customers and giving superior professional service with value behind a name you can trust. We have been in business for 27 years and have been very fortunate to be awarded the opportunity to service many hotels, hospitals, wineries, restaurants, weddings, special events, corporate functions, concerts, country clubs of which many of these customers we now call friends. We have established a consistent long track record with our customers by standing behind the word "Certified" and what it means to us.
            </p>
            <p class="flex-1 px-16 leading-loose">
                We feel the bar needs to be set higher than what is currently set by industry standards. By electing to set criteria for parking and shuttling from the point of view of the customer, we have established a winning formula which is constantly being improved.
            </p>
        </div>
    </div>

    <div class="bg-fixed bg-cover" style="background-image: url('/img/vineyard1.jpg')">
        <div class="flex flex-col container mx-auto py-16 text-white content-center">
            <blockquote class="text-center leading-loose mb-16">
                <p class="text-4xl mb-6">"CPA Valet is clearly the MVP company for parking!"</p>
                <cite class="text-2xl">
                    <div>
                        <img src="/img/montana-signature.png">
                    </div>
                    <div class="-mt-4">
                        Joe & Jennifer Montana
                    </div>
                    <div>

                    </div>
                </cite>
            </blockquote>

            <h2
                class="flex justify-center max-w-lg mx-auto uppercase tracking-wide border px-6 py-3 mb-8"
            >
                A Couple Accolades
            </h2>
            <div class="flex flex-col lg:flex-row border-b pb-8 mb-6">
                <div class="w-auto mb-16 lg:mb-0 lg:w-1/2 mx-16 leading-normal">
                    <blockquote>
                        <p class="my-6 text-xl">
                            The Marin Community Clinics Event was a roaring success. Guests and vendors only had the most positive remarks!
                        </p>
                        <p class="my-6 text-xl">
                            You and your well trained staff set the stage and were the first introduction to event. You set the tone. I appreciate your attention to detail and friendly attitude that welcomes the guests so graciously.
                        </p>
                        <p class="my-6 text-xl">
                            I look forward to working with you soon.
                        </p>
                        <cite class="text-lg">~ Marilyn McCann Coyote, Marin Community Clinics</cite>
                    </blockquote>
                </div>
                <div class="w-auto lg:w-1/2 mx-16 leading-normal">
                    <blockquote>
                        <p class="my-6 text-xl">
                            Just wanted to thank you again for the WONDERFUL service you provided for Mom's Birthday Party at Rossi's last Saturday. I truly hope that you all got something to eat and drink that day. We received so many compliments about how nice and attentive each of you were. Thank you so very, very much!!
                        </p>
                        <cite class="text-lg">~ Janet</cite>
                    </blockquote>
                </div>
            </div>
            <div class="flex justify-center">
                <a
                    href="{{ route('accolades') }}"
                    class="no-underline uppercase text-white hover:text-brand"
                >
                    Read more...
                </a>
            </div>
        </div>
    </div>
    <div class="container mx-auto my-16">
        <h2 class="flex justify-center text-3xl mb-8">Why Choose {{ config('company.name') }}</h1>
        <div class="flex flex-col justify-center md:flex-row">
            @component('components/accolade')
                @slot('title')
                    Excellent Service
                @endslot
                Service minded staff. We look for ways to help and go beyond our scope of duties.
            @endcomponent

            @component('components/accolade')
                @slot('title')
                    Professional Appearance
                @endslot
                Clean, pressed, well-kept embroidered uniforms. Employees are well-groomed, with a name tag for each employee.
            @endcomponent

            @component('components/accolade')
                @slot('title')
                    Personal, Warm & Friendly
                @endslot
                Our employees are always smiling, eager to please, caring and just love making people happy!
            @endcomponent
        </div>
        <div class="flex flex-col justify-center md:flex-row">
            @component('components/accolade')
                @slot('title')
                    Professionally Trained
                @endslot
                Our employees are professionally trained in the art of parking/shuttling and have an extensive knowledge of all types of vehicles.
            @endcomponent

            @component('components/accolade')
                @slot('title')
                    Punctual
                @endslot
                We provide you with a locally based valet team that will show up promptly for your event.
            @endcomponent

            @component('components/accolade')
                @slot('title')
                    Prepared
                @endslot
                Our valet/shuttle team supplies your event with all of the necessary tools. We ensure there is a plan in place upstream to ensure an outstanding event.
            @endcomponent
        </div>
        <div class="flex flex-col justify-center md:flex-row">
            @component('components/accolade')
                @slot('title')
                    We Love It!
                @endslot
                Our team of employees love their work and are proud of the company for which they work. We are only as good as our employees.
            @endcomponent

            @component('components/accolade')
                @slot('title')
                    Strict Hiring Criteria
                @endslot
                Our hiring process envolves background checks, being entered into DMV pull-program, classroom trained, vehicle training, and etiquette training so you know they are CERTIFIED.
            @endcomponent

            @component('components/accolade')
                @slot('title')
                    Insurance
                @endslot
                A company carrying highest insurance policy limits along with an additional umbrella policy.
            @endcomponent
        </div>
    </div>
    <div class="mb-16">
        @foreach (array_chunk(array_slice($instagram, 0, 6), 3) as $chunk)
            <div class="flex flex-col sm:flex-row">
                @foreach ($chunk as $image)
                    <a
                        href="{{ $image['link'] }}"
                        target="_blank"
                        class="w-full sm:w-1/3 relative masonry"
                        style="background-image: url('{{ $image['url'] }}')"
                    >
{{--                         @if ($image['caption'])
                            <p
                                class="text-white text-sm leading-normal text-center bg-black p-2 m-2 absolute pin-b"
                                style="background: rgba(0,0,0,0.6)"
                            >
                                {{ $image['caption'] }}
                            </p>
                        @endif
 --}}                    </a>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
