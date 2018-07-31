<?php

namespace App\Http\Controllers\Contract\Deposit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContractDepositController extends Controller
{
    public function index()
    {
        return view('contract.deposit');
    }
}
