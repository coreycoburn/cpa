@extends('layouts.app', [
    'title' => ($data->previously_signed) ? ucfirst($data->quote_type) . ' #' . $data->contract_number . ' Signed' : 'Sign ' . ucfirst($data->quote_type) . ' #' . $data->contract_number,
    'icon' => ($data->previously_signed) ? 'check-circle' : NULL
])

@if($data->previously_signed === false)
@push('pdf')
<script src="//mozilla.github.io/pdf.js/build/pdf.js" defer></script>
@endpush
@endif

@section('body')
    @if($data->previously_signed === true)
        <div id="top" class="container mx-auto my-8 md:my-16 px-8 max-w-lg text-lg">
            <p>Dear {{ $data->social_title }} {{ $data->last_name }},</p>
            <p>
                We have received signed {{ $data->quote_type }} #{{ $data->contract_number }} for your event on <span class="font-bold">{{ $data->event_date }}</span>. An email has been sent to you that includes your signed {{ $data->quote_type }}.
            </p>
            <p>
                For your convenience, you may download your signed {{ $data->quote_type }}:
            </p>
            <button
                class="flex items-center bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 mb-6 rounded"
                onclick="window.location.href='{{ $data->pdf }}&save=1'"
            >
                <div class="fill-current text-white mr-3">
                    @svg('cloud-download-alt', 'h-8')
                </div>
                 <div>Download Signed <span class="capitalize">{{ $data->quote_type }}</span></div>
            </button>
        </div>

        <div class="bg-grey-lighter md:py-8 mb-8">
            <div id="top" class="container mx-auto my-16 md:px-8">
                <div class="flex flex-col md:flex-row">
                    <cpa-revise
                        type="{{ $data->quote_type }}"
                        box-width="md:w-1/2"
                        contract="{{ $data->contract_number }}"
                        :contract-id="{{ $data->contract_id }}"
                        email="{{ $data->email }}"
                    >
                        Have details changed for your event that will affect the services outlined in {{ $data->quote_type }} #{{ $data->contract_number }}? Please let us know the changes so we can revise the letter.
                    </cpa-revise>

                    <div class="flex flex-col w-full md:w-1/2 mr-6 bg-white p-6 border-t-4 border-green shadow text-center">
                        <h3 class="mb-4 text-center">Pay Deposit</h3>
                        <p class="flex-1 text-left">
                            In order to keep our services secured for your event, a deposit of $###.## is due by ##/##/####.
                        </p>
                        <a
                            class="justify-end bg-green hover:bg-green-dark text-white text-sm tracking-wide uppercase no-underline font-bold py-3 px-6 mx-6 rounded"
                            href="deposit?sign={{ $data->data }}"
                        >
                            Pay Deposit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container mx-auto my-16 px-8 max-w-lg text-lg">
            <p>Dear {{ $data->social_title }} {{ $data->last_name }},</p>
            <p>
                Please review the following {{ $data->quote_type }} for {{ $data->services }} for your event on <span class="font-bold">{{ $data->event_date }}</span>. To secure our services, please sign at the bottom of this page.
            </p>
            <div class="bg-orange-lightest border-l-4 border-orange text-orange-dark px-4 py-1 mt-8" role="alert">
                <p class="font-bold capitalize text-sm my-2">
                    Having Trouble Viewing <span class="capitalize">{{ $data->quote_type }}?</span>
                </p>
                <p class="text-xs my-1">
                    In the event that your web browser is not displaying the {{ $data->quote_type }} below, you can review and sign it by viewing the attachment in the email we sent you.
                </p>
            </div>
        </div>

        <div class="container mx-auto my-16 px-8 text-lg">
            <div class="flex justify-center mb-8 lg:hidden">
                <div>
                    @svg('arrow-alt-circle-left', 'h-6 fill-current')
                </div>
                <div class="mx-6">
                    scroll to view {{ $data->quote_type }}
                </div>
                <div>
                    @svg('arrow-alt-circle-right', 'h-6 fill-current')
                </div>
            </div>
        </div>

        <div class="text-center mb-16 overflow-x-auto scrolling-touch">
            <cpa-pdf
                url="{{ $data->pdf }}"
                type="{{ $data->quote_type }}"
                :scale="1.6"
                :sig-y="{{ $data->sig_y }}"
            ></cpa-pdf>
        </div>

        <div class="container mx-auto my-16 px-8 text-lg">
            <div class="flex justify-center mb-8 lg:hidden">
                <div>
                    @svg('arrow-alt-circle-left', 'h-6 fill-current')
                </div>
                <div class="mx-6">
                    scroll to view {{ $data->quote_type }}
                </div>
                <div>
                    @svg('arrow-alt-circle-right', 'h-6 fill-current')
                </div>
            </div>
        </div>

        <div class="container mx-auto my-16 md:px-8 text-lg">
            <cpa-sign-contract-page
                data="{{ $data->data }}"
                pdf="{{ $data->pdf }}"
                today="{{ $data->today }}"
                type="{{ $data->quote_type }}"
                contract="{{ $data->contract_number }}"
                :event="{{ $data->event_id }}"
                :contract-id="{{ $data->contract_id }}"
                proposal="{{ $data->proposal_id }}"
                confirmation="{{ $data->confirmation_id }}"
                first-name="{{ $data->first_name }}"
                last-name="{{ $data->last_name }}"
                email="{{ $data->email }}"
                office-contact="{{ config('company.email.special_events') }}"
                :signed-count="{{ $data->signedCount }}"
            >
            </cpa-sign-contract-page>
        </div>
    @endif
@endsection
