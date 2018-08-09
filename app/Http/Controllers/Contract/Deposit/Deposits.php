<?php

namespace App\Http\Controllers\Contract\Deposit;

use App\Event;

class Deposits
{
    private $event;
    private $due;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function total()
    {
        return (int) $this->event->payments()->sum('amount');
    }
    public function due()
    {
        return ($this->event->deposit_due - $this->total());
    }

    public function due_in_dollars()
    {
        return number_format($this->due() / 100, 2);
    }
}
