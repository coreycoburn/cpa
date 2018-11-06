@extends('layouts.app', ['title' => 'Make Deposit Payment'])

@push('payments')
<script src="https://js.stripe.com/v3/"></script>
@endpush

@section('body')
    <div class="container mx-auto text-xl max-w-xl mt-16">
        <cpa-deposits
            client-name="{{ $contract->social_title }} {{ $contract->last_name }}"
            event-type="{{ $contract->event_type }}"
            event-date="{{ $contract->formatted_event_date }}"
            due-date="{{ $event->formatted_deposit_due_date }}"
            due-date-humans="{{ $event->deposit_due_for_humans }}"
            :original-due="{{ $event->deposit_due_in_dollars }}"
            :estimated-total="{{ $event->estimated_total_in_dollars }}"
            :payments="{{ $payments }}"
        >
        </cpa-deposits>
    </div>
@endsection
