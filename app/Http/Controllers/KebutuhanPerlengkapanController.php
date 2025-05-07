<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perlengkapan;

class KebutuhanPerlengkapanController extends Controller
{
    public function index()
    {
        $perlengkapan = Perlengkapan::all();
        return view('pelanggan.kebutuhanperlengkapan', compact('perlengkapan'));
    }

public function show($id)
{
    $perlengkapan = \App\Models\Perlengkapan::findOrFail($id);
    return view('pelanggan.detailkebutuhanperlengkapan', compact('perlengkapan'));
}
}
