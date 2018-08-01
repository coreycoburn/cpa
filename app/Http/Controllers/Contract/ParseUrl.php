<?php

namespace App\Http\Controllers\Contract;

use App\Exceptions\InvalidContractQuery;

class ParseUrl
{
    private $data;

    public function __construct()
    {
        $sign = request()->sign;
        $url = encrypt_decrypt('decrypt', $sign, config('contract.key'));
        $url_parts = parse_url($url);

        $this->checkForValidQuery($url_parts);

        parse_str($url_parts['query'], $url_data);

        $data = [
            'sign' => $sign
        ];

        $merged_data = array_merge($url_data, $data);
        $this->data = $this->_cast($merged_data);
    }

    public function get($items = NULL)
    {
        return get($this->data, $items);
    }

    private function _cast($data)
    {
        return [
            'client' => (int) $data['client'],
            'proposal_id' => isset($data['proposal_id']) ? (int) $data['proposal_id'] : NULL,
            'confirmation_id' => isset($data['confirmation_id']) ? (int) $data['confirmation_id'] : NULL,
            'contract_id' => (int) $data['contract_id'],
            'expires' => (int) $data['expires'],
            'signature' => $data['signature'],
            'sign' => $data['sign'],
            'sig_y' => $data['sig_y']
        ];
    }

    private function checkForValidQuery($query)
    {
        if (! isset($query['query'])) {
            throw new InvalidContractQuery;
        }
    }
}
