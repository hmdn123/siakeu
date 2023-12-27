<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


// Route yang dapat di akses dengan login
Route::middleware(['auth'])->group(function () {
    Route::resource('/home', HomeController::class)->middleware('checkRole:Owner,Admin');
    Route::resource('/transaksi', TransaksiController::class)->middleware('checkRole:Owner,Admin');
    Route::controller(LaporanController::class)->group(function () {
        Route::get('/laporan/all', 'all');
        Route::get('/laporan/pemasukan', 'pemasukan');
        Route::get('/laporan/pengeluaran', 'pengeluaran');
        Route::get('/laporan/download/excel', 'export_excel');
        Route::get('/laporan/view/pdf', 'view_pdf');
        Route::get('/laporan/download/pdf', 'export_pdf');
    })->middleware('checkRole:Owner,Admin');
    Route::resource('/setting', SettingController::class)->middleware('checkRole:Owner');
});

Auth::routes([
    'register' => true,
    'verify' => false,
    'reset' => false
]);