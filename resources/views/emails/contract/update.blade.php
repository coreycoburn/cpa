@component('mail::message')
# Signed Contract

Dear {{ $socialTitle }} {{ $lastName }},

We have received your signed contract for {{ strtolower($contractType) }} #{{ $contractNumber }} on {{ $eventDate }} for the {!! $eventType !!}.

We have attached a copy of the signed contract for your records. If you have not already done so, a deposit must be made by {{ $depositDueDate }} for.

@endcomponent
