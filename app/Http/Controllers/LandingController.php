<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('/')]
class LandingController extends Controller
{
    #[Get('', name: 'landingpage')]
    public function index()
    {
        return view('landing', [
            "listKegiatan" => $this->listKegiatan(),
        ]);
    }

    public function listKegiatan()
    {
        return [
            "IMG-20250614-WA0059.jpg",
            "IMG-20250614-WA0061.jpg",
            "IMG-20250614-WA0062.jpg",
            "IMG-20250614-WA0063.jpg",
            "IMG-20250614-WA0064.jpg",
            "IMG-20250614-WA0065.jpg",
            "IMG-20250614-WA0066.jpg",
            "IMG-20250614-WA0067.jpg",
            "IMG-20250614-WA0068.jpg",
            "IMG-20250614-WA0069.jpg"
        ];
    }
}
