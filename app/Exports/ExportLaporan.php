<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportLaporan implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $transaksi = Transaksi::select("*")
                                ->orderBy('created_at')
                                ->get();
        $total_pemasukan = Transaksi::where('jenis', 'Pemasukan')
                                      ->sum('nominal');
        $total_pengeluaran = Transaksi::where('jenis', 'Pengeluaran')
                                      ->sum('nominal');
        $saldo_akhir = $total_pemasukan - $total_pengeluaran;

        return view('Laporan.All.table',  compact(
                'transaksi',
                'total_pemasukan',
                'total_pengeluaran',
                'saldo_akhir'
            ));
    }
}
