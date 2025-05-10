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
        return view('landing');
    }
}
