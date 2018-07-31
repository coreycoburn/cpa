@component('mail::message')
Dear {{ $socialTitle }} {{ $lastName }},

Thank you for your time. We hope you will consider us for your next event. Please don't hesitate to reply to this email if you would like to discuss other service options.

@if($message)
Feedback:
@component('mail::panel')
{{ $message }}
@endcomponent
@endif

#### Reference to {{ $contractType }} #{{ $contractNumber }}

@endcomponent
