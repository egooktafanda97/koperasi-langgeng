<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Pengumuman;
use App\Models\ProdukUnit;
use App\Models\Unit;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('/dashboard')]
#[Middleware('auth')]
class DashboardController extends Controller
{

    #[Get("", name: 'dashboard.index')]
    public function index()
    {
        return view('pages.dashboard.index', [
            "unit" => Unit::all()->count(),
            "laporan" => Laporan::all()->count(),
            "produk" => ProdukUnit::all()->count(),
            "pengumuman" => Pengumuman::all()->count(),
        ]);
    }
}
