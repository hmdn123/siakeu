<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function index(): View
    {
        $jenis = Jenis::all();
        return view('Setting.Jenis.index', compact('jenis'));
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'kode'          => 'required',
            'keterangan'    => 'required',
        ]);

        //create Transaksi
        Jenis::create([
            'kode'          => $request->kode,
            'keterangan'    => $request->keterangan,
        ]);

        //redirect to index
        return redirect()->route('jenis.index')->with(['success' => 'Data Berhasil Dibuat!']);
    }

    public function update(Request $request, $id)
    {
        Jenis::find($id)->update(['keterangan' => $request->keterangan]);
        return redirect()->route('jenis.index')->with(['success' => 'Data Berhasil Diedit!']);
    }
}
