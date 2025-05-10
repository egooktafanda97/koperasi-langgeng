<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix("login")]
class LoginController extends Controller
{
    #[Get("", name: 'login')]
    public function index()
    {
        return view('auth.login');
    }

    #[Post("", name: 'login.post')]
    public function post(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard.index')->with('success', 'Login berhasil');
        }

        return redirect()->back()->withErrors(['email' => 'Email atau password salah']);
    }
}
