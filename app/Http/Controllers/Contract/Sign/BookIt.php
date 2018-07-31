<?php

namespace App\Http\Controllers\Contract\Sign;

use App\Confirmation;
use App\Event;
use App\Proposal;

class BookIt
{
    private $contract;

    public function __construct($request)
    {
        $event = Event::find($request['client']);
        $event->book_client = 'yes';
        $event->book_client_time = now();
        $event->save();

        $type = str_plural($request['type']);
        $type_id = $request['type'] . '_id';

        $query = ['event_id' => $request['client'], $type_id => $request[$type_id]];

        if ($request['type'] === 'proposal') {
            $contract = Proposal::where($query)->first();
        } else if ($request['type'] === 'confirmation') {
            $contract = Confirmation::where($query)->first();
        }

        $contract->book_client = 'yes';
        $contract->book_client_time = now();
        $contract->save();

        $this->contract = $contract;

        return;
    }

    public function contract()
    {
        return $this->contract;
    }
}
