@component('mail::message')
# Signed Contract

Dear {{ $socialTitle }} {{ $lastName }},

We have received your signed contract for {{ strtolower($contractType) }} #{{ $contractNumber }} on {{ $eventDate }} for the {!! $eventType !!}.

We have attached a copy of the signed contract for your records. If you have not already done so, a deposit must be made by {{ $depositDueDate }} for.

## Pay Deposit
In order to keep our services secured, a deposit must be paid by
### add date here
@component('mail::button', ['url' => route('contract-deposit', ['data' => $param])])
Pay Deposit
@endcomponent

@endcomponent
