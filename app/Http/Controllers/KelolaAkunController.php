<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\KelolaAkun;
use Illuminate\Http\Request;

class KelolaAkunController extends Controller
{
    public function index()
    {
        $akuns = KelolaAkun::all();
        return view('kelola_akun.index', compact('akuns'));
    }

    public function create()
    {
        return view('kelola_akun.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:akun,email',
            'password' => 'required',
            'role' => 'required'
        ]);

        KelolaAkun::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('kelola_akun.index')->with('success', 'Akun berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $akun = KelolaAkun::findOrFail($id);
        return view('kelola_akun.edit', compact('akun'));
    }

    public function update(Request $request, $id)
    {
        $akun = KelolaAkun::findOrFail($id);

        $akun->nama = $request->nama;
        $akun->email = $request->email;
        $akun->role = $request->role;

        if ($request->filled('password')) {
            $akun->password = Hash::make($request->password);
        }

        $akun->save();

        return redirect()->route('kelola_akun.index')->with('success', 'Akun berhasil diperbarui!');
    }

    public function destroy($id)
    {
        KelolaAkun::destroy($id);
        return redirect()->route('kelola_akun.index')->with('success', 'Akun berhasil dihapus.');
    }
}
