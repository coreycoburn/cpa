<?php

namespace App\Http\Controllers;

use App\Website;
use App\Social\Instagram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class MarketingController extends Controller
{
    public function welcome()
    {
        // $instagram = (new Instagram('instagram'))
        //     ->getInstagram();

        $instagram = [];
        return view('welcome', compact('instagram'));
    }

    public function about()
    {
        return view('about');
    }

    public function services()
    {
        return view('services');
    }

    public function accolades()
    {
        return view('accolades');
    }

    public function employment()
    {
        return view('employment');
    }
}
