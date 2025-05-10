<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('/log-activity')]
class LogActivityController extends Controller
{

    #[Get('/', name: 'log-activity.index')]
    public function index(Request $request)
    {
        return view('pages.log-activity.index');
    }

    //log show
    #[Get('/show', name: 'log-activity.show')]
    public function show()
    {
        $inQuery = Activity::latest()
            ->paginate($request->limit ?? 5);

        $startNumber = ($inQuery->currentPage() - 1) * $inQuery->perPage() + 1;
        $data = collect($inQuery->items())->map(function ($item, $index) use ($startNumber) {
            $item->no = $startNumber + $index;
            $item->created_atx = Carbon::parse($item->created_at)->translatedFormat('d F Y H:i');
            return $item;
        });
        return response()->json([
            'data' => $data,
            'total' => $inQuery->total(),
            'page' => $inQuery->currentPage(),
            'limit' => $inQuery->perPage(),
        ]);
    }
}
