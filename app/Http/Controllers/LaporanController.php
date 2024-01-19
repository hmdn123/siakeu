<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Transaksi;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request): View
    {
        $total_pemasukan = Transaksi::where('jenis', 'Debit')
                ->sum('nominal');
        $total_pengeluaran = Transaksi::where('jenis', 'Kredit')
                ->sum('nominal');
        $saldo_akhir = $total_pemasukan - $total_pengeluaran;
        $jenis = Jenis::all();

        $data = Transaksi::orderBy('created_at')
            ->when($request->date_from && $request->date_to,
                function (Builder $builder) use ($request){
                    $builder->whereBetween(
                        DB::raw('DATE(created_at)'), [
                            $request->date_from,
                            $request->date_to
                        ]);
                })
            ->when($request->kode != null,
                function($q) use ($request) {
                    return $q->where('kode', $request->kode);
                })
            ->when($request->jenis != null,
                function($q) use ($request) {
                    return $q->where('jenis', $request->jenis);
                })
            ->get();

        return view('Laporan.index',compact(
            'total_pemasukan',
            'total_pengeluaran',
            'saldo_akhir',
            'jenis',
            'data',
            'request'
        ));
        
    }
}
