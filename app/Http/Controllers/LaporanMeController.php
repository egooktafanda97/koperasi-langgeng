<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Unit;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Put;

#[Prefix("laporan-me")]
class LaporanMeController extends Controller
{
    #[Get('/', name: 'laporan-me.index')]
    public function index()
    {
        $laporans = Laporan::with('unit')->paginate(10);
        return view('pages.laporan-me.index', compact('laporans'));
    }

    #[Get('/create', name: 'laporan-me.create')]
    public function create()
    {
        $units = Unit::all();
        return view('pages.laporan-me.create', compact('units'));
    }

    #[Post('/store', name: 'laporan-me.store')]
    public function store(Request $request)
    {
        $request->validate([
            'bulan' => 'required',
            'file_laporan' => 'nullable|file|mimes:pdf,doc,docx',
            'pendapatan' => 'required|numeric',
            'pengeluaran' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->except('file_laporan');

        if ($request->hasFile('file_laporan')) {
            $data['file_laporan'] = $request->file('file_laporan')->store('laporan-me', 'public');
        }
        Laporan::create(collect($data)->merge([
            "unit_id" => auth()->user()->unit_id,
            "status" => 'menunggu'
        ])->toArray());

        return redirect()->route('laporan-me.index')->with('success', 'Laporan berhasil ditambahkan.');
    }

    #[Get('/edit/{id}', name: 'laporan-me.edit')]
    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);
        $units = Unit::all();
        return view('pages.laporan-me.edit', compact('laporan', 'units'));
    }

    #[Put('/update/{id}', name: 'laporan-me.update')]
    public function update(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);

        $request->validate([
            'bulan' => 'required',
            'file_laporan' => 'nullable|file|mimes:pdf,doc,docx',
            'pendapatan' => 'required|numeric',
            'pengeluaran' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->except('file_laporan');

        if ($request->hasFile('file_laporan')) {
            $data['file_laporan'] = $request->file('file_laporan')->store('laporan-me', 'public');
        }


        $laporan->update($data);

        return redirect()->route('laporan-me.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * list
     * @return \Illuminate\Http\JsonResponse
     */
    #[Get('/laporan-me-masuk/list', name: 'laporan-me.masuk.list')]
    public function list(Request $request)
    {
        $inQuery = Laporan::when($request->get("Bulan"), function ($query) use ($request) {

            $query->where('bulan', 'like', '%' . $request->get("Bulan") . '%');
        })
            ->when($request->get("unit_id"), function ($query) use ($request) {
                $query->where('unit_id', $request->get("unit_id"));
            })
            ->when($request->get("status"), function ($query) use ($request) {
                $query->where('status', $request->get("status"));
            })
            ->with(['unit'])
            ->where('unit_id', auth()->user()->unit_id)
            ->orderBy('id', 'desc')
            ->paginate($request->limit ?? 5);

        $startNumber = ($inQuery->currentPage() - 1) * $inQuery->perPage() + 1;
        $data = collect($inQuery->items())->map(function ($item, $index) use ($startNumber) {
            $item->no = $startNumber + $index;
            return $item;
        });
        return response()->json([
            'data' => $data,
            'total' => $inQuery->total(),
            'page' => $inQuery->currentPage(),
            'limit' => $inQuery->perPage(),
        ]);
    }


    /**
     * list
     * @return \Illuminate\Http\JsonResponse
     */
    #[Post('/change-status', name: 'laporan-me.change.status')]
    public function ChangeStatus(Request $request)
    {
        $laporan = Laporan::findOrFail($request->id);

        $request->validate([
            'status' => 'required',
        ]);

        $laporan->update([
            'status' => $request->status
        ]);

        return redirect()->route('laporan-me.index')->with('success', 'Status laporan-me berhasil diperbarui.');
    }

    // rekapitulasi
    #[Get('/rekapitulasi', name: 'laporan-me.rekapitulasi')]
    public function rekapitulasi(Request $request)
    {
        return view('pages.laporan-me.rekapitulasi');
    }

    // rekapitulasi
    #[Get('/rekapitulasi/list', name: 'laporan-me.rekapitulasi.list')]
    public function rekapitulasiList(Request $request)
    {
        $inQuery = Laporan::when($request->get("Bulan"), function ($query) use ($request) {

            $query->where('bulan', 'like', '%' . $request->get("Bulan") . '%');
        })
            ->when($request->get("unit_id"), function ($query) use ($request) {
                $query->where('unit_id', $request->get("unit_id"));
            })
            ->when($request->get("status"), function ($query) use ($request) {
                $query->where('status', $request->get("status"));
            })
            ->where('status', '!=', 'menunggu')
            ->with(['unit'])
            ->orderBy('id', 'desc')
            ->paginate($request->limit ?? 5);

        $startNumber = ($inQuery->currentPage() - 1) * $inQuery->perPage() + 1;
        $data = collect($inQuery->items())->map(function ($item, $index) use ($startNumber) {
            $item->no = $startNumber + $index;
            return $item;
        });
        return response()->json([
            'data' => $data,
            'total' => $inQuery->total(),
            'page' => $inQuery->currentPage(),
            'limit' => $inQuery->perPage(),
        ]);
    }

    #[Get('/file-path/{id}', name: 'laporan-me.file.path')]
    public function pathFileById($id)
    {
        $laporan = Laporan::findOrFail($id);
        return response()->json($laporan->file_laporan ? asset('storage/' . $laporan->file_laporan) : null);
    }

    // print
    #[Get('/laporan-print', name: 'laporan-me.rekapitulasi.print')]
    public function printLaporanMe(Request $request)
    {
        $laporan = Laporan::when($request->get("Bulan"), function ($query) use ($request) {

            $query->where('bulan', 'like', '%' . $request->get("Bulan") . '%');
        })
            ->when($request->get("unit_id"), function ($query) use ($request) {
                $query->where('unit_id', $request->get("unit_id"));
            })
            ->when($request->get("status"), function ($query) use ($request) {
                $query->where('status', $request->get("status"));
            })
            ->with(['unit'])
            ->where('unit_id', auth()->user()->unit_id)
            ->orderBy('id', 'desc')
            ->get();
        return view('pages.laporan.print-laporan', compact('laporan'));
    }
}
