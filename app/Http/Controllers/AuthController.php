<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan form login admin
     */
    public function showLoginForm()
    {
        return view('Auth.login'); // resources/views/Auth/login.blade.php
    }

    /**
     * Proses login admin
     */
    public function login(Request $request)
    {
        // Validasi input dari form
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt login dengan email dan password
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // regenerasi session

            return redirect()->intended('/beranda')->with('success', 'Login berhasil!');
        }

        // Jika gagal login, kembalikan ke form login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    /**
     * Proses logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/loginadmin')->with('success', 'Berhasil logout.');
    }
}
