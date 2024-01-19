<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $transaksi = Transaksi::select("*")
                                ->orderBy('created_at')
                                ->get();
        $total_pemasukan = Transaksi::where('jenis', 'Debit')
                                      ->sum('nominal');
        $total_pengeluaran = Transaksi::where('jenis', 'Kredit')
                                      ->sum('nominal');
        $saldo_akhir = $total_pemasukan - $total_pengeluaran;
        return view('home', compact(
                'transaksi',
                'total_pemasukan',
                'total_pengeluaran',
                'saldo_akhir'
            ));
    }
}
