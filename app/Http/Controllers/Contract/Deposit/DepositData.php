<?php

namespace App\Http\Controllers\Contract\Deposit;

use App\Confirmation;
use App\Http\Controllers\Contract\Recipient;
use App\Proposal;

class DepositData
{
    private $contract;
    private $data = [];

    public function __construct($request)
    {
        if ($request->proposal_id) {
            $this->contract = Proposal::find($request->contract_id);
        } else if ($request->confirmation_id) {
            $this->contract = Confirmation::find($request->contract_id);
        }

        $this->_recipient();

        $this->data['event_type'] = $this->contract->event_type;
        $this->data['formatted_event_date'] = $this->contract->formatted_event_date;
    }

    public function get()
    {
        return (object) $this->data;
    }

    private function _recipient()
    {
        $this->data = array_merge($this->data, (new Recipient($this->contract))->get());
    }
}
