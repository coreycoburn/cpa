<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class QuoteRequest extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $customer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer)
    {
        // Name
        $customer['full_name'] = $customer['fname'] . ' ' . $customer['lname'];

        // Contact Address
        $customer['full_contact_address1'] = ($customer['contact_address']) ? $customer['contact_address'] : '';
        $customer['full_contact_address2'] = ($customer['contact_address']) ?
            $customer['contact_city'] . ', ' . $customer['contact_state'] . ' ' . $customer['contact_zip'] : '';

        // Event Address
        $customer['full_event_address1'] = ($customer['event_address']) ? $customer['event_address'] : '';
        $customer['full_event_address2'] = ($customer['event_address']) ?
            $customer['event_city'] . ', ' . $customer['event_state'] . ' ' . $customer['event_zip'] : '';

        // Event Date
        $customer['event_date'] = Carbon::parse()->toFormattedDateString($customer['event_date']);

        // Event Times
        $customer['start'] = convert_time_to_carbon($customer['start']);
        $customer['start_advertised'] = convert_time_to_carbon($customer['start_advertised']);
        $customer['end'] = convert_time_to_carbon($customer['end']);

        // Annual Event
        $customer['annual_event'] = ($customer['annual_event'] === 0) ? 'No' : 'Yes';

        // CPA Services
        $services = ($customer['service_valet']) ? $customer['service_valet'] . ', ' : '';
        $services .= ($customer['service_direction']) ? $customer['service_direction'] . ', ' : '';
        $services .= ($customer['service_shuttle']) ? $customer['service_shuttle'] . ', ' : '';
        $services .= ($customer['service_coordination']) ? $customer['service_coordination'] . ', ' : '';
        $services = rtrim($services, ', ');
        $customer['services'] = $services;

        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.quote.new')
            ->from('events@cpavalet.com');
    }
}
