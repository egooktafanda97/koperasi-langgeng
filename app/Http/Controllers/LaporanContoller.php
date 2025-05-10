<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Enum\StatusLaporanEnum;
use Illuminate\Support\Facades\Auth;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('/laporan')]
class LaporanContoller extends Controller
{
    #[Get('/', name: 'laporan.index')]
    public function index()
    {
        $laporans = Laporan::with('unit')->paginate(10);
        return view('pages.laporan.index', compact('laporans'));
    }

    #[Get('/create', name: 'laporan.create')]
    public function create()
    {
        $units = Unit::all();
        return view('pages.laporan.create', compact('units'));
    }

    #[Post('/store', name: 'laporan.store')]
    public function store(Request $request)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'bulan' => 'required',
            'file_laporan' => 'nullable|file|mimes:pdf,doc,docx',
            'pendapatan' => 'required|numeric',
            'pengeluaran' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->except('file_laporan');

        if ($request->hasFile('file_laporan')) {
            $data['file_laporan'] = $request->file('file_laporan')->store('laporan', 'public');
        }
        Laporan::create(collect($data)->merge([
            "status" => 'menunggu'
        ])->toArray());

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil ditambahkan.');
    }

    #[Get('/edit/{id}', name: 'laporan.edit')]
    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);
        $units = Unit::all();
        return view('pages.laporan.edit', compact('laporan', 'units'));
    }

    #[Put('/update/{id}', name: 'laporan.update')]
    public function update(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);

        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'bulan' => 'required',
            'file_laporan' => 'nullable|file|mimes:pdf,doc,docx',
            'pendapatan' => 'required|numeric',
            'pengeluaran' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->except('file_laporan');

        if ($request->hasFile('file_laporan')) {
            $data['file_laporan'] = $request->file('file_laporan')->store('laporan', 'public');
        }

        $laporan->update($data);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * list
     * @return \Illuminate\Http\JsonResponse
     */
    #[Get('/laporan-masuk/list', name: 'laporan.masuk.list')]
    public function list(Request $request)
    {
        $inQuery = Laporan::when($request->search, function ($query) use ($request) {
            $query->where('bulan', 'like', '%' . $request->search . '%');
        })
            ->where("status", "menunggu")
            ->with(['unit'])
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
    #[Post('/change-status', name: 'laporan.change.status')]
    public function ChangeStatus(Request $request)
    {
        $laporan = Laporan::findOrFail($request->id);

        $request->validate([
            'status' => 'required',
        ]);

        $laporan->update([
            'status' => $request->status
        ]);

        return redirect()->route('laporan.index')->with('success', 'Status laporan berhasil diperbarui.');
    }

    // rekapitulasi
    #[Get('/rekapitulasi', name: 'laporan.rekapitulasi')]
    public function rekapitulasi(Request $request)
    {
        return view('pages.laporan.rekapitulasi', [
            "unit" => Unit::all()
        ]);
    }

    // rekapitulasi
    #[Get('/rekapitulasi/list', name: 'laporan.rekapitulasi.list')]
    public function rekapitulasiList(Request $request)
    {
        $inQuery = Laporan::when($request->header("Bulan"), function ($query) use ($request) {

            $query->where('bulan', 'like', '%' . $request->header("Bulan") . '%');
        })
            ->when($request->header("unit_id"), function ($query) use ($request) {
                $query->where('unit_id', $request->header("unit_id"));
            })
            ->when($request->header("status"), function ($query) use ($request) {
                $query->where('status', $request->header("status"));
            })
            ->where('status', '!=', 'menunggu')
            ->with(['unit'])
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

    #[Get('/file-path/{id}', name: 'laporan.file.path')]
    public function pathFileById($id)
    {
        $laporan = Laporan::findOrFail($id);
        return response()->json($laporan->file_laporan ? asset('storage/' . $laporan->file_laporan) : null);
    }

    #[Get('/laporan-print', name: 'laporan.rekapitulasi.print')]
    public function print(Request $request)
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
            ->get();
        return view('pages.laporan.print-laporan', compact('laporan'));
    }
}
