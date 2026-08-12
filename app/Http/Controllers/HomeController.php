<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Gallery;
use App\Models\Testimoni;
use App\Models\Marketing;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $beritas = Berita::where('status', 'published')->latest()->take(2)->get();
        $galleries = Gallery::latest()->get();
        $testimonis = Testimoni::where('status', 'published')->latest()->get();
        $marketings = Marketing::where('status', 'online')->latest()->get();

        return view('user.pages.index', compact('beritas', 'galleries', 'testimonis', 'marketings'));
    }
}
