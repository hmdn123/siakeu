<?php

namespace App\Http\Controllers;

use App\Exports\ExportLaporan;
use App\Models\Jenis;
use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
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
        $jenis = Jenis::all();
        return view(
            'Laporan.index',
            compact(
                'transaksi',
                'total_pemasukan',
                'total_pengeluaran',
                'saldo_akhir',
                'jenis'
            )
        );
    }

    public function all(): View
    {
        $transaksi = Transaksi::select("*")
            ->orderBy('created_at')
            ->get();
        $total_pemasukan = Transaksi::where('jenis', 'Pemasukan')
            ->sum('nominal');
        $total_pengeluaran = Transaksi::where('jenis', 'Pengeluaran')
            ->sum('nominal');
        $saldo_akhir = $total_pemasukan - $total_pengeluaran;
        return view(
            'Laporan.All.index',
            compact(
                'transaksi',
                'total_pemasukan',
                'total_pengeluaran',
                'saldo_akhir'
            )
        );
    }

    public function pemasukan(): View
    {
        $history_pemasukan = Transaksi::where('jenis', 'Pemasukan')
            ->orderBy('created_at')
            ->get();
        $total_pemasukan = Transaksi::where('jenis', 'Pemasukan')
            ->sum('nominal');
        return view(
            'Laporan.Pemasukan.index',
            compact(
                'history_pemasukan',
                'total_pemasukan'
            )
        );
    }

    public function pengeluaran(): View
    {
        $history_pengeluaran = Transaksi::where('jenis', 'Pengeluaran')
            ->orderBy('created_at')
            ->get();
        $total_pengeluaran = Transaksi::where('jenis', 'Pengeluaran')
            ->sum('nominal');
        return view(
            'Laporan.Pengeluaran.index',
            compact(
                'history_pengeluaran',
                'total_pengeluaran'
            )
        );
    }

    public function export_excel()
    {
        return Excel::download(new ExportLaporan, "laporan keuangan.xlsx");
    }

    public function view_pdf()
    {
        $mpdf = new \Mpdf\Mpdf();
        $transaksi = Transaksi::select("*")
                                ->orderBy('created_at')
                                ->get();
        $total_pemasukan = Transaksi::where('jenis', 'Pemasukan')
                                      ->sum('nominal');
        $total_pengeluaran = Transaksi::where('jenis', 'Pengeluaran')
                                      ->sum('nominal');
        $saldo_akhir = $total_pemasukan - $total_pengeluaran;
        $mpdf->WriteHTML(view('Laporan.table',  compact(
            'transaksi',
            'total_pemasukan',
            'total_pengeluaran',
            'saldo_akhir'
        )));
        $mpdf->Output();
    }

    public function export_pdf()
    {
        $mpdf = new \Mpdf\Mpdf();
        $transaksi = Transaksi::select("*")
                                ->orderBy('created_at')
                                ->get();
        $total_pemasukan = Transaksi::where('jenis', 'Pemasukan')
                                      ->sum('nominal');
        $total_pengeluaran = Transaksi::where('jenis', 'Pengeluaran')
                                      ->sum('nominal');
        $saldo_akhir = $total_pemasukan - $total_pengeluaran;
        $mpdf->WriteHTML(view('Laporan.table',  compact(
            'transaksi',
            'total_pemasukan',
            'total_pengeluaran',
            'saldo_akhir'
        )));
        $mpdf->Output('laporan keuangan.pdf', 'D');
    }
}
