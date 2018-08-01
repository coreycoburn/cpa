<?php

namespace App\Http\Controllers\Contract;

use App\Confirmation;
use App\Http\Controllers\Contract\Recipient;
use App\Http\Controllers\Contract\Sign\Signed;
use App\Http\Controllers\Contract\Sign\UploadSignature;
use App\Proposal;
use Illuminate\Support\Carbon;

class ContractData
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
        $this->_serviceList();

        $this->data['contract_id'] = $this->contract->id;
        $this->data['contract_number'] = $this->contract->contract_number;
        $this->data['event_id'] = $this->contract->event_id;
        $this->data['proposal_id'] = $request->proposal_id;
        $this->data['confirmation_id'] = $request->confirmation_id;
        $this->data['event_date'] = Carbon::parse($this->contract->event_date)->format('l, F j, Y');
        $this->data['quote_type'] = (is_int($request->proposal_id)) ? 'proposal' : 'confirmation';

        $this->data['data'] = $request->sign;
        $this->data['pdf'] = config('contract.url') . 'contract.php?sign=' . $request->sign;
        $this->data['today'] = Carbon::now()->format('D, M j, Y');
        $this->data['previously_signed'] = $this->_uploadExists($request);
        $this->data['signedCount'] = $this->_signedCount($request);
        $this->data['sig_y'] = $request->sig_y;
    }

    public function getContract()
    {
        return $this->contract;
    }

    public function get()
    {
        return (object) $this->data;
    }

    private function _recipient()
    {
        $this->data = array_merge($this->data, (new Recipient($this->contract))->get());
    }

    private function _serviceList()
    {
        $services = [
            strtolower($this->contract->service_valet),
            strtolower($this->contract->service_direction),
            strtolower($this->contract->service_shuttle),
            strtolower($this->contract->service_fixed),
            strtolower($this->contract->service_coordination)
        ];

        $services = array_filter($services);

        $servicesString = join(' and ', array_filter(array_merge([join(', ', array_slice($services, 0, -1))], array_slice($services, -1)), 'strlen'));

        $this->data['services'] = $servicesString . ' ' . str_plural('services', count($services));
    }

    private function _uploadExists($request)
    {
        return (new UploadSignature($request))->exists();
    }

    private function _signedCount($request)
    {
        return (new Signed())->count($request->client);
    }
}
