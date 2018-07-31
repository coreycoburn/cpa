<?php

namespace App\Http\Controllers\Contract\Sign;

use App\Confirmation;
use App\Proposal;

class Signed
{
    public function count($eventId)
    {
        $proposals = Proposal::where('event_id', $eventId)
            ->where('book_client', 'yes')
            ->count();

        $confirmations = Confirmation::where('event_id', $eventId)
            ->where('book_client', 'yes')
            ->count();

        return ($proposals + $confirmations);
    }
}
