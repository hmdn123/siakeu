<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(): View
    {
        $transaksi = Transaksi::select("*")
            ->orderBy('tgl_input')
            ->get();
        $total_pemasukan = Transaksi::where('jenis', 'Debit')
            ->sum('nominal');
        $total_pengeluaran = Transaksi::where('jenis', 'Kredit')
            ->sum('nominal');
        $saldo_akhir = $total_pemasukan - $total_pengeluaran;
        $jenis = Jenis::all();
        return view(
            'Transaksi.index',
            compact(
                'transaksi',
                'total_pemasukan',
                'total_pengeluaran',
                'saldo_akhir',
                'jenis',
            )
        );
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'kode'         => 'required',
            'keterangan'   => 'required',
            'jenis'        => 'required',
            'detail'       => 'required',
            'tgl_input'    => 'required',
            'nominal'      => 'required',
        ]);

        //create Transaksi
        Transaksi::create([
            'kode'         => $request->kode,
            'keterangan'   => $request->keterangan,
            'jenis'        => $request->jenis,
            'detail'       => $request->detail,
            'tgl_input'    => $request->tgl_input,  // Ensure 'tgl_input' is included
            'nominal'      => $request->nominal,
            'user_id'      => auth()->user()->id,
        ]);

        //redirect to index
        return redirect('transaksi')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit($id)
    {
        $transaksi = Transaksi::find($id);
        $jenis = Jenis::all();
        return view('Transaksi.edit', compact([
            'transaksi',
            'jenis'
        ]));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'kode'         => 'required',
            'keterangan'    => 'required',
            'jenis'        => 'required',
            'tgl_input'        => 'required',
            'detail'       => 'required',
            'nominal'      => 'required',
        ]);

        //get transaksi by ID
        $transaksi = Transaksi::findOrFail($id);

        //updated
        $transaksi->update([
            'kode'         => $request->kode,
            'keterangan'   => $request->keterangan,
            'jenis'        => $request->jenis,
            'tgl_input'    => $request->tgl_input,
            'detail'       => $request->detail,
            'nominal'      => $request->nominal,
            'user_id'      => auth()->user()->id,
        ]);

        //redirect to index
        return redirect('transaksi')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        //get transaksi by ID
        $transaksi = Transaksi::findOrFail($id);

        //delete transaksi
        $transaksi->delete();

        //redirect to index
        return back()->with(['success' => 'Data Transaksi Telah Dihapus']);
    }
}
