<?php

namespace App\Http\Controllers\Contract;

use App\Event;
use App\Exceptions\QuoteDeclined;
use App\Http\Controllers\Contract\ParseUrl;

class Declined
{
    public $declined = false;

    public function __construct(ParseUrl $request)
    {
        $event = Event::where('id', $request->get('client'))
            ->select('book_client')
            ->first();

        if ($event->book_client === 'td') {
            $this->declined = true;

            throw new QuoteDeclined;
        }

        return;
    }
}
