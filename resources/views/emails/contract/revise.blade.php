@component('mail::message')
# Change Request Received

Dear {{ $socialTitle }} {{ $lastName }},

We will review and respond to your change request for {{ $contractTypeLower }} #{{ $contractNumber }} for your {{ $eventType }} on {{ $eventDate }}.

Requested Changes:
@component('mail::panel')
{{ $message }}
@endcomponent

@endcomponent
