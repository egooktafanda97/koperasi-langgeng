<?php

namespace App\Http\Controllers;

use App\Models\ProdukUnit;
use App\Models\Unit;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Put;

#[Prefix('/produk-unit')]
class ProdukContoller extends Controller
{
    #[Get('/', name: 'produk_unit.index')]
    public function index()
    {
        return view('pages.produk_unit.index');
    }

    #[Get('/create', name: 'produk_unit.create')]
    public function create()
    {
        $units = Unit::all();
        return view('pages.produk_unit.create', compact('units'));
    }

    #[Post('/store', name: 'produk_unit.store')]
    public function store(Request $request)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'nama_produk' => 'required|string|max:100',
            'jenis_produk' => 'required|in:barang,jasa',
            'satuan' => 'nullable|string|max:50',
            'keterangan' => 'nullable|string',
        ]);

        ProdukUnit::create($request->only([
            'unit_id',
            'nama_produk',
            'jenis_produk',
            'satuan',
            'keterangan'
        ]));

        return redirect()->route('produk_unit.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    #[Get('/edit/{id}', name: 'produk_unit.edit')]
    public function edit($id)
    {
        $produk = ProdukUnit::findOrFail($id);
        $units = Unit::all();
        return view('pages.produk_unit.edit', compact('produk', 'units'));
    }

    #[Put('/update/{id}', name: 'produk_unit.update')]
    public function update(Request $request, $id)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'nama_produk' => 'required|string|max:100',
            'jenis_produk' => 'required|in:barang,jasa',
            'satuan' => 'nullable|string|max:50',
            'keterangan' => 'nullable|string',
        ]);

        $produk = ProdukUnit::findOrFail($id);
        $produk->update($request->only([
            'unit_id',
            'nama_produk',
            'jenis_produk',
            'satuan',
            'keterangan'
        ]));

        return redirect()->route('produk_unit.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * list
     * @param \Illuminate\Http\Request $request
     */
    #[Get('/list', name: 'produk_unit.list')]
    public function list(Request $request)
    {
        $inQuery = ProdukUnit::with(['unit'])
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
}
