<?php

namespace App\Http\Controllers\Contract;

use App\Confirmation;
use App\Proposal;

class ContractType
{
    private $event;

    public function __construct($request)
    {
        if ($request->type === 'proposal') {
            $this->event = Proposal::find($request->contract_id);
        } else {
            $this->event = Confirmation::find($request->contract_id);
        }
    }

    public function get()
    {
        return $this->event;
    }
}
