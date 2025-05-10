<?php

namespace App\Http\Controllers;

use App\Models\KategoriUsaha;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Put;

#[Prefix('/user')]
class UserController extends Controller
{

    // form ganti password
    #[Post('/form-ganti-password', name: 'user.form_ganti_password')]
    public function formGantiPassword(Request $request)
    {
        $user = User::find($request->user_id);
        return view('pages.user.form_ganti_password', compact('user'));
    }

    /**
     * ganti password
     */
    #[Post('/ganti-password', name: 'user.ganti_password')]
    public function gantiPassword(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ]);

        $user =  User::find($request->user_id);
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diubah');
    }

    // show user
    #[Get("data", name: "user.data")]
    public function userEdit()
    {
        $userX = User::where("unit_id", auth()->user()->unit_id)
            ->first();
        $unit = Unit::where("id", auth()->user()->unit_id)
            ->first();
        $kategori = KategoriUsaha::all();
        return view("pages.users.show", compact('unit', "kategori"));
    }

    /**
     * update
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Unit $unit
     */
    #[Put('/{unit}/update', name: 'user_unit.update')]
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

        return redirect()->route('user.data')->with('success', 'Unit Usaha dan akun berhasil diperbarui.');
    }
}
