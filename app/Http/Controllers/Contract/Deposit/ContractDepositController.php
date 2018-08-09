<?php

namespace App\Http\Controllers\Contract\Deposit;

use App\Event;
use App\Http\Controllers\Contract\Deposit\DepositData;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContractDepositController extends Controller
{
    public function index()
    {
        $params = $this->_getParams(request());

        $contract = (new DepositData($params))->get();

        $event = Event::find($params->client);
        $payments = $event->payments->toJson();

        return view('contract.deposit', compact(['event', 'contract', 'payments']));
    }

    private function _getParams($request)
    {
        return (object) $request->get('params');
    }
}
