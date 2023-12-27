<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;

class PemasukanController extends Controller
{
    public function index(): View
    {
        $history_pemasukan = Transaksi::where('jenis', 'Pemasukan')
                                ->orderBy('created_at')
                                ->get();
        $total_pemasukan = Transaksi::where('jenis', 'Pemasukan')
                                      ->sum('nominal');
        return view('Pemasukan.index',
            compact(
                'history_pemasukan',
                'total_pemasukan'
            )
        );
    }
}
