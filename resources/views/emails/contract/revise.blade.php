@component('mail::message')
# Request Changes

Dear {{ $socialTitle }} {{ $lastName }},

We have received your request to modify the letter for your {{ $eventType }} on {{ $eventDate }}. We will review the change request and will respond to your request shortly.

Requested Changes:
@component('mail::panel')
{{ $message }}
@endcomponent

#### Reference to {{ $contractType }} #{{ $contractNumber }}

@endcomponent
