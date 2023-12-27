<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;

class PengeluaranController extends Controller
{
    public function index(): View
    {
        $history_pengeluaran = Transaksi::where('jenis', 'Pengeluaran')
                                ->orderBy('created_at')
                                ->get();
        $total_pengeluaran = Transaksi::where('jenis', 'Pengeluaran')
                                      ->sum('nominal');
        return view('Pengeluaran.index',
            compact(
                'history_pengeluaran',
                'total_pengeluaran'
            )
        );
    }
}
