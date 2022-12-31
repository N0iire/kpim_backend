<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\CatatanBeliController;
use App\Http\Controllers\CatatanJualController;
use App\Http\Controllers\CicilanController;
use App\Http\Controllers\DetailNonPembelianController;
use App\Http\Controllers\DetailPinjamanController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PembelianController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SimpananWajibController;
use App\Http\Controllers\SimpananSukarelaController;
use App\Http\Controllers\SimpananPokokController;
use App\Http\Controllers\PemodalController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PinjamanController;
use App\Http\Middleware\Restricted;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// POST
Route::post('/login', [ApiAuthController::class, 'login'])->name('login.api');
Route::post('/register', [ApiAuthController::class, 'register'])->name('register.api');
Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout.api');
Route::post('/laporan/pemasukan', [PemasukanController::class, 'find']);
Route::post('/laporan/pengeluaran', [PengeluaranController::class, 'find']);
Route::post('/bayar-cicilan/{pinjaman}', [PinjamanController::class, 'bayarCicilan']);
Route::post('/snap-token/{pinjaman}', [PinjamanController::class, 'snapToken']);

// RESOURCES
Route::apiResources([
    'barang' => BarangController::class,
    'catatan-beli' => CatatanBeliController::class,
    'catatan-jual' => CatatanJualController::class,
    'cicilan' => CicilanController::class,
    'detail-non-pembelian' => DetailNonPembelianController::class,
    'detail-pinjaman' => DetailPinjamanController::class,
    'pengeluaran' => PengeluaranController::class,
    'pemasukan' => PemasukanController::class,
    'pemodal' => PemodalController::class,
    'pembelian' => PembelianController::class,
    'penjualan' => PenjualanController::class,
    'pinjaman' => PinjamanController::class,
    'simpanan-pokok' => SimpananPokokController::class,
    'simpanan-sukarela' => SimpananSukarelaController::class,
    'simpanan-wajib' => SimpananWajibController::class,
    'user' => UserController::class,
]);

// RESTRICTED
Route::middleware(Restricted::class)->group(function () {
    Route::post('/barang', [BarangController::class, 'store']);
    Route::post('/cicilan', [CicilanController::class, 'store']);
    Route::post('/detail-pinjaman', [DetailPinjamanController::class, 'store']);
    Route::post('/pembelian', [PembelianController::class, 'store']);
    Route::post('/penjualan', [PenjualanController::class, 'store']);
});
