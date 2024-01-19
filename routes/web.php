<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NeracaController;
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
    Route::resource ('/home', HomeController::class)
            ->middleware('checkRole:Owner,Admin');
    Route::controller(TransaksiController::class)->group(function () {
        Route::get      ('/transaksi',              'index');
        Route::get      ('/transaksi/edit/{id}',    'edit');
        Route::post     ('/transaksi/store',    'store');
        Route::put      ('/transaksi/update/{id}',  'update');
        Route::delete   ('/transaksi/delete/{id}',  'destroy');
    })->middleware('checkRole:Owner,Admin');
    Route::controller(LaporanController::class)->group(function () {
        Route::get('/laporan', 'index');
        Route::post('/laporan', 'index');
    })->middleware('checkRole:Owner,Admin');
    Route::controller(NeracaController::class)->group(function () {
        Route::get('/neraca', 'index');
    })->middleware('checkRole:Owner,Admin');
    Route::resource ('/setting', SettingController::class)
            ->middleware('checkRole:Owner');
    Route::resource ('/jenis', JenisController::class)
            ->middleware('checkRole:Owner');
});

Auth::routes([
    'register' => true,
    'verify' => false,
    'reset' => false
]);