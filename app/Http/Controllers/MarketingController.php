<?php

namespace App\Http\Controllers;

use App\Social\Instagram;
use App\Website;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function welcome()
    {
        $instagram = (new Instagram('instagram'))
            ->getInstagram();

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

    public function quote()
    {
        return view('quote');
    }
}
