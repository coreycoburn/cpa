<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContractDepositController extends Controller
{
    public function index()
    {
        return view('contract.deposit');
    }
}
