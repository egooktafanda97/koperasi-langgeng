<?php

namespace App\Http\Controllers;

use App\Models\KategoriUsaha;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Put;

#[Prefix('/unit-usaha')]
class UnitUsahaController extends Controller
{
    #[Get('/', name: 'unit_usaha.index')]
    public function index()
    {
        return view('pages.unit_usaha.index');
    }

    /**
     * create
     * @return \Illuminate\Contracts\View\View
     */
    #[Get('/create', name: 'unit_usaha.create')]
    public function create()
    {
        $kategori = KategoriUsaha::all();
        return view('pages.unit_usaha.create', compact('kategori'));
    }

    /**
     * store
     * @param \Illuminate\Http\Request $request
     */
    #[Post('/store', name: 'unit_usaha.store')]
    public function store(Request $request)
    {
        $request->validate([
            'nama_unit' => 'required|string|max:100',
            'kategori_usaha_id' => 'required',
            'penanggung_jawab' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'deskripsi' => 'nullable|string',

            'user_name' => 'required|string|max:100',
            'user_email' => 'required|email|unique:users,email',
            'user_password' => 'required|string|min:6',
            'user_phone' => 'nullable|string|max:20',
            'user_address' => 'nullable|string',
        ]);

        // Simpan Unit Usaha terlebih dahulu
        $unit = Unit::create([
            'nama_unit' => $request->nama_unit,
            'kategori_usaha_id' => $request->kategori_usaha_id,
            'penanggung_jawab' => $request->penanggung_jawab,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
        ]);

        // Simpan akun User untuk Unit
        User::create([
            'name' => $request->user_name,
            'email' => $request->user_email,
            'password' => Hash::make($request->user_password),
            'role' => 'unit',
            'unit_id' => $unit->id,
            'phone' => $request->user_phone,
            'address' => $request->user_address,
        ]);

        return redirect()->route('unit_usaha.index')->with('success', 'Unit Usaha dan akun berhasil dibuat.');
    }


    /**
     * edit
     * @param \App\Models\Unit $unit
     * @return \Illuminate\Contracts\View\View
     */
    #[Get('/{unit}/edit', name: 'unit_usaha.edit')]
    public function edit(Unit $unit)
    {
        $kategori = KategoriUsaha::all();
        return view('pages.unit_usaha.edit', compact('unit', 'kategori'));
    }

    /**
     * update
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Unit $unit
     */
    #[Put('/{unit}/update', name: 'unit_usaha.update')]
    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'nama_unit' => 'required|string|max:100',
            'kategori_usaha_id' => 'required',
            'penanggung_jawab' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'deskripsi' => 'nullable|string',

            'user_name' => 'required|string|max:100',
            'user_email' => 'required|email|unique:users,email,' . $unit->user->id,
            'user_password' => 'nullable|string|min:6',
            'user_phone' => 'nullable|string|max:20',
            'user_address' => 'nullable|string',
        ]);

        // Update Unit Usaha
        $unit->update([
            'nama_unit' => $request->nama_unit,
            'kategori_usaha_id' => $request->kategori_usaha_id,
            'penanggung_jawab' => $request->penanggung_jawab,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
        ]);

        // Update akun User untuk Unit
        $unit->user()->update([
            'name' => $request->user_name,
            'email' => $request->user_email,
            'password' => $request->user_password ? Hash::make($request->user_password) : $unit->user->password,
            'phone' => $request->user_phone,
            'address' => $request->user_address,
        ]);

        return redirect()->route('unit_usaha.index')->with('success', 'Unit Usaha dan akun berhasil diperbarui.');
    }

    /**
     * destroy
     * @param \App\Models\Unit $unit
     */
    #[Delete('/{unit}/destroy', name: 'unit_usaha.destroy')]
    public function destroy(Unit $unit)
    {
        try {
            $unit->user()->delete();
            $unit->delete();
            return response()->json([
                'message' => 'Unit Usaha dan akun berhasil dihapus.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Unit Usaha tidak dapat dihapus karena ada data yang terkait.',
            ], 422);
        }
    }

    /**
     * list
     * @param \Illuminate\Http\Request $request
     */
    #[Get('/list', name: 'unit_usaha.list')]
    public function list(Request $request)
    {
        $inQuery = Unit::when($request->search, function ($query) use ($request) {
            $query->where('nama_unit', 'like', '%' . $request->search . '%')
                ->orWhere('kategori_usaha_id', 'like', '%' . $request->search . '%')
                ->orWhere('penanggung_jawab', 'like', '%' . $request->search . '%');
        })
            ->with(['kategoriUsaha', 'user'])
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
}
