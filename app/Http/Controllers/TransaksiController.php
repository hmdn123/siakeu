<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(): View
    {
        $transaksi = Transaksi::select("*")
                                ->orderBy('created_at')
                                ->get();
        $total_pemasukan = Transaksi::where('jenis', 'Pemasukan')
                                      ->sum('nominal');
        $total_pengeluaran = Transaksi::where('jenis', 'Pengeluaran')
                                      ->sum('nominal');
        $saldo_akhir = $total_pemasukan - $total_pengeluaran;
        return view('Transaksi.index', 
            compact(
                'transaksi',
                'total_pemasukan',
                'total_pengeluaran',
                'saldo_akhir')
            );
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'jenis'         => 'required',
            'keterangan'    => 'required',
            'nominal'       => 'required',
        ]);

        //create Transaksi
        Transaksi::create([
            'jenis'         => $request->jenis,
            'keterangan'    => $request->keterangan,
            'nominal'       => $request->nominal,
            'user_id' => auth()->user()->id,
        ]);

        //redirect to index
        return redirect()->route('transaksi.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'jenis'         => 'required',
            'keterangan'    => 'required',
            'nominal'       => 'required',
        ]);
        
        //get transaksi by ID
        $transaksi = Transaksi::findOrFail($id);

        //updated
        $transaksi->update([
            'jenis'         => $request->jenis,
            'keterangan'    => $request->keterangan,
            'nominal'       => $request->nominal,
        ]);

        //redirect to index
        return redirect()->route('transaksi.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    
    public function destroy($id): RedirectResponse
    {
        //get transaksi by ID
        $transaksi = Transaksi::findOrFail($id);

        //delete transaksi
        $transaksi->delete();

        //redirect to index
        return redirect()->route('transaksi.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
