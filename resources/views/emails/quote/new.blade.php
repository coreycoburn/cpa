@component('mail::message')
# Quote From CPA Valet

Dear {{ $customer['fname'] }},

Thank you for taking the time to fill out the form at {{ config('company.url_short') }}. We have received your event information and will contact you within the next business day. The following information is what you submitted to us at [{{ config('company.url_short') }}]({{ config('company.url') }}).

Please make sure your event details are accurate. If any information is inaccurate, please reply to this e-mail or call us at {{ config('company.phone.main') }}.

@component('mail::panel')
    ## Contact Info:
    Name: {!! $customer['full_name'] !!}
    Company: {!! $customer['company'] !!}
    Phone: {{ $customer['phone'] }}
    Fax: {{ $customer['fax'] }}
    Email: {{ $customer['email'] }}
    Address:
        {!! $customer['full_contact_address1'] !!}
        {!! $customer['full_contact_address2'] !!}
@endcomponent

@component('mail::panel')
    ## Event Info:
    Event Date: {{ $customer['event_date'] }}

    Guest Arrival (est): {{ $customer['start'] }}
    Advertisted Event Start: {{ $customer['start_advertised'] }}
    Event End: {{ $customer['end'] }}

    Type of Service(s): {{ $customer['services'] }}
    Type of Event: {!! $customer['event_type'] !!}

    Guest Count: {{ $customer['guests'] }}
    Car Count (est): {{ $customer['cars'] }}

    Address:
        {!! $customer['full_event_address1'] !!}
        {!! $customer['full_event_address2'] !!}

    Type of Location: {!! $customer['location_type'] !!}
    Name of Location: {!! $customer['location_name'] !!}
@endcomponent

@component('mail::panel')
    ## Additional Info:
    Annual Event: {{ $customer['annual_event'] }}
    Preferred Means of Correspondence: {{ $customer['contact_method'] }}
    Referred By: {!! $customer['referral'] !!}

    Special requests / Additional comments:
    {!! $customer['message'] !!}
@endcomponent

If you have further questions you may also contact us at {{ config('company.phone.main') }} or reply to this e-mail. We look forward to working with you!

@component('mail::subcopy')
@endcomponent

Thank you,<br>
The {{ config('company.name') }} team
@endcomponent
