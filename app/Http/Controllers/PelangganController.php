<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\KelolaAkun;

class PelangganController extends Controller
{
    // Menampilkan form login
    public function showMasuk()
    {
        return view('pelanggan.masuk');
    }

    // Proses login (tanpa Auth)
    public function masuk(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $akun = KelolaAkun::where('email', $request->email)->first();

        if ($akun && Hash::check($request->password, $akun->password)) {
            session(['pelanggan_id' => $akun->id, 'pelanggan_nama' => $akun->nama]);
            return redirect()->route('berandauser');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    // Menampilkan form daftar
    public function showDaftar()
    {
        return view('pelanggan.daftar');
    }

    // Proses pendaftaran
    public function daftar(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:akun,email',
            'password' => 'required|confirmed|min:6',
        ]);

        KelolaAkun::create([
            'nama' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pelanggan',
        ]);

        return redirect()->route('pelanggan.masuk')->with('success', 'Pendaftaran berhasil. Silakan masuk.');
    }

    // Logout
    public function keluar()
    {
        session()->forget(['pelanggan_id', 'pelanggan_nama']);
        return redirect()->route('pelanggan.masuk');
    }
}
