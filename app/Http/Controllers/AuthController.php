<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('Auth.login'); // Pastikan view ini ada di: resources/views/Auth/login.blade.php
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Cegah session fixation
            
            // Kirim pesan sukses setelah berhasil login
            return redirect()->intended('/beranda')->with('success', 'Selamat datang! Anda berhasil login.');
        }

        // Kalau gagal login, kirim error dan input kembali
        return back()
            ->withErrors([
                'email' => 'Email atau password salah.',
            ])
            ->withInput($request->only('email')); // Menjaga input email setelah gagal login
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();      // Invalidate session lama
        $request->session()->regenerateToken(); // Generate CSRF token baru

        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}
