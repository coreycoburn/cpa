<?php

namespace App\Http\Controllers\Quote;

use App\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientQuote;
use App\Mail\QuoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Propaganistas\LaravelPhone\PhoneNumber;

class QuoteController extends Controller
{
    public function index()
    {
        return view('quote');
    }

    public function store(StoreClientQuote $request)
    {
        $validated = $request->validated();
        $services = $validated['services'];

        $services['service_valet'] = ($services['service_valet']) ? 'Valet' : '';
        $services['service_direction'] = ($services['service_direction']) ? 'Parking Direction' : '';
        $services['service_shuttle'] = ($services['service_shuttle']) ? 'Shuttle' : '';
        $services['service_coordination'] = ($services['service_coordination']) ? 'Event Coordination' : '';

        $validated['phone'] = PhoneNumber::make($validated['phone'], 'US')->formatForCountry('US');
        $validated['phone'] .=
            ($validated['phone_ext']) ? ' ext. ' . $validated['phone_ext'] : '';

        $validated['start_advertised'] = convert_time_to_decimal($validated['start_advertised']);
        $validated['start'] = convert_time_to_decimal($validated['start']);
        $validated['end'] = convert_time_to_decimal($validated['end']);
        $validated['quote_from_internet'] = 1;

        unset($validated['services']);
        unset($validated['phone_ext']);

        $validated = array_merge($validated, $services);

        Mail::to($validated['email'])
            ->cc('soraya@cpavalet.com')
            ->bcc(['events@cpavalet.com', 'events2@cpavalet.com'])
            ->queue(new QuoteRequest($validated));

        Event::create($validated);
    }
}
