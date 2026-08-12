<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        return view('user.pages.destination');
    }

    public function detail($slug)
    {
        // Ubah slug 'surabaya' / 'united-states' menjadi 'Surabaya' / 'United States'
        $countryName = ucwords(str_replace('-', ' ', $slug));

        // Panggil file user/pages/detail-destination.blade.php
        return view('user.pages.detail-destination', compact('countryName'));
    }
}
