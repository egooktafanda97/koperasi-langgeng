<?php

namespace App\Http\Controllers;

use App\Models\KategoriUsaha;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Put;

#[Prefix('/kategori-usaha')]
class KategoriUsahaContoller extends Controller
{
    /**
     * index
     * @return \Illuminate\Contracts\View\View
     */
    #[Get('/', name: 'kategori_usaha.index')]
    public function index()
    {
        return view('pages.kategori_usaha.index');
    }

    /**
     * create
     * @return \Illuminate\Contracts\View\View
     */
    #[Get('/create', name: 'kategori_usaha.create')]
    public function create()
    {
        return view('pages.kategori_usaha.create');
    }

    /**
     * store
     * @param \Illuminate\Http\Request $request
     */
    #[Post('/store', name: 'kategori_usaha.store')]
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        // Simpan Kategori Usaha
        $kategoriUsaha = new KategoriUsaha();
        $kategoriUsaha->nama_kategori = $request->nama_kategori;
        $kategoriUsaha->deskripsi = $request->deskripsi;
        $kategoriUsaha->save();

        return redirect()->route('kategori_usaha.index')->with('success', 'Kategori Usaha berhasil ditambahkan');
    }

    /**
     * edit
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    #[Get('/edit/{id}', name: 'kategori_usaha.edit')]
    public function edit(Request $request, $id)
    {
        $kategori = KategoriUsaha::findOrFail($id);
        return view('pages.kategori_usaha.edit', compact('kategori'));
    }

    /**
     * update
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    #[Put('/update/{id}', name: 'kategori_usaha.update')]
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        // Update Kategori Usaha
        $kategoriUsaha = KategoriUsaha::findOrFail($id);
        $kategoriUsaha->nama_kategori = $request->nama_kategori;
        $kategoriUsaha->deskripsi = $request->deskripsi;
        $kategoriUsaha->save();

        return redirect()->route('kategori_usaha.index')->with('success', 'Kategori Usaha berhasil diperbarui');
    }

    /**
     * destroy
     * @param int $id
     */
    #[Post('/destroy/{id}', name: 'kategori_usaha.destroy')]
    public function destroy($id)
    {
        $kategoriUsaha = KategoriUsaha::findOrFail($id);
        $kategoriUsaha->delete();

        return redirect()->route('kategori_usaha.index')->with('success', 'Kategori Usaha berhasil dihapus');
    }

    /**
     * list
     * @return \Illuminate\Http\JsonResponse
     */
    #[Get('/list', name: 'kategori_usaha.list')]
    public function list(Request $request)
    {
        $inQuery = KategoriUsaha::when($request->search, function ($query) use ($request) {
            $query->where('nama_kategori', 'like', '%' . $request->search . '%')
                ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        })
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
