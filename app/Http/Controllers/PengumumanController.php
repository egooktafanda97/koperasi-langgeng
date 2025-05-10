<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Put;

#[Prefix('/pengumuman')]
class PengumumanController extends Controller
{
    #[Get('/', name: 'pengumuman.index')]
    public function index()
    {
        $pengumuman = Pengumuman::latest()->get();
        return view('pages.pengumuman.index', compact('pengumuman'));
    }

    #[Get('/pengumuman-show', name: 'pengumuman.show')]
    public function indexShow()
    {
        $pengumuman = Pengumuman::latest()->get();
        return view('pages.pengumuman.show', compact('pengumuman'));
    }

    #[Get('/create', name: 'pengumuman.create')]
    public function create()
    {
        return view('pages.pengumuman.create');
    }

    #[Post('/store', name: 'pengumuman.store')]
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:150',
            'isi' => 'required',
            'file_lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png',
        ]);

        $file = null;
        if ($request->hasFile('file_lampiran')) {
            $file = $request->file('file_lampiran')->store('pengumuman', 'public');
        }

        Pengumuman::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'file_lampiran' => $file,
            'tampilkan' => $request->has('tampilkan'),
        ]);

        return redirect()->route('pengumuman.index')->with('success', 'Berhasil tambah pengumuman');
    }

    #[Get('/edit/{id}', name: 'pengumuman.edit')]
    public function edit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('pages.pengumuman.edit', compact('pengumuman'));
    }

    #[Put('/update/{id}', name: 'pengumuman.update')]
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|max:150',
            'isi' => 'required',
            'file_lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png',
        ]);

        $item = Pengumuman::findOrFail($id);

        if ($request->hasFile('file_lampiran')) {
            if ($item->file_lampiran && Storage::exists('public/' . $item->file_lampiran)) {
                Storage::delete('public/' . $item->file_lampiran);
            }
            $item->file_lampiran = $request->file('file_lampiran')->store('pengumuman', 'public');
        }

        $item->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'file_lampiran' => $item->file_lampiran,
            'tampilkan' => $request->has('tampilkan'),
        ]);

        return redirect()->route('pengumuman.index')->with('success', 'Berhasil update pengumuman');
    }

    #[Delete('/{id}/destroy', name: 'pengumuman.destroy')]
    public function destroy($id)
    {
        $item = Pengumuman::findOrFail($id);

        if ($item->file_lampiran && Storage::exists('public/' . $item->file_lampiran)) {
            Storage::delete('public/' . $item->file_lampiran);
        }

        $item->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil hapus pengumuman',
        ]);
    }

    // pengumuman.list
    #[Get('/list', name: 'pengumuman.list')]
    public function list(Request $request)
    {
        $inQuery = Pengumuman::query()
            ->orderBy('created_at', 'desc')
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
     * pengumuman.show
     */
    #[Get('/pages-show/{id}', name: 'pengumuman.show.pages')]
    public function showPages(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('pages.pengumuman.pages', compact('pengumuman'));
    }
}
