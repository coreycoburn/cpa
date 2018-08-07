@extends('layouts.app', ['title' => 'Deposit Due: $' . $event->deposit_due_in_dollars])

@section('body')
    <div class="container mx-auto">
        <p>Dear {{ $contract->social_title }} {{ $contract->last_name }},</p>
        <p>Original Amt Due: $</p>
        <p>
            In order to keep our servcies secure for your {{ $contract->event_type }} on {{ $contract->formatted_event_date }}, please make a payment of ${{ $event->deposit_due_in_dollars }} i
        </p>
        {{ $event->deposit_due_in_dollars }}
    </div>
@endsection
