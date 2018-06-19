<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientQuote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        return view('quote');
    }

    public function store(StoreClientQuote $request)
    {
        $validated = $request->validated();

        dd($validated);
    }
}
