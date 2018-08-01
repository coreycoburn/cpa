@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('company.url')])
            <img src="{{ asset('img/email/logo.png') }}" alt="{{ config('company.name') }} logo">
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            &copy; {{ date('Y') }} {{ config('company.legal_name') }}. All rights reserved.<br>
            Ph: {{ config('company.phone.main') }} or {{ config('company.phone.alt') }} | Fx: {{ config('company.phone.fax') }}<br><br>
            [{{ config('company.url_short') }}]({{ config('company.url') }}) | [{{ config('company.email.main') }}](mailto:{{ config('company.email.main') }})

        @endcomponent
    @endslot
@endcomponent
