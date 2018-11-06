<?php

namespace App\Http\Controllers\Contract\Deposit;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

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

    public function store(PaymentRequest $request)
    {
        $validated = (object) $request->validated();

        dump($validated);

        $customer = Stripe::customers()->create([
          'email' => 'joe@example.com'
        ]);

        return response()->json(['message' => 'success'], 201);
    }

    private function _getParams($request)
    {
        return (object) $request->get('params');
    }
}
