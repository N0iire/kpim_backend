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

Route::group(['middleware' => ['cors', 'json.response']], function () {

    // POST
    Route::post('/login', [ApiAuthController::class, 'login'])->name('login.api');
    Route::post('/register', [ApiAuthController::class, 'register'])->name('register.api');
    Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout.api');
    Route::post('/laporan/pemasukan', [PemasukanController::class, 'find']);
    Route::post('/laporan/pengeluaran', [PengeluaranController::class, 'find']);
    Route::post('/bayar-cicilan/{pinjaman}', [PinjamanController::class, 'bayarCicilan']);
    
    // GET
    Route::get('/simpanan-wajib/{user:username}', [UserController::class, 'simpananWajib']);
    Route::get('/simpanan-pokok/{user:username}', [UserController::class, 'simpananPokok']);
    Route::get('/simpanan-sukarela/{user:username}', [UserController::class, 'simpananSukarela']);
    Route::get('/pinjaman/{user:username}', [UserController::class, 'pinjaman']);
    Route::get('/pinjaman/details/{pinjaman}', [PinjamanController::class, 'detailPinjaman']);
    Route::get('/cicilan/{pinjaman}', [PinjamanController::class, 'cicilan']);
    Route::get('/pembelian/details/{catatanBeli}', [CatatanBeliController::class, 'detailPembelian']);
    Route::get('/penjualan/details/{catatanJual}', [CatatanJualController::class, 'detailPenjualan']);
    Route::get('/reminder-cicilan/{pinjaman}', [PinjamanController::class, 'reminderCicilan']);
    Route::get('/total-pinjaman/false/{user:username}', [PinjamanController::class, 'totalPinjamanFalse']);

    // RESOURCES
    Route::apiResources([
        'barang' => BarangController::class,
        'cicilan' => CicilanController::class,
        'catatan-beli' => CatatanBeliController::class,
        'catatan-jual' => CatatanJualController::class,
        'detail-pinjaman' => DetailPinjamanController::class,
        'detail-non-pembelian' => DetailNonPembelianController::class,
        'simpanan-pokok' => SimpananPokokController::class,
        'simpanan-sukarela' => SimpananSukarelaController::class,
        'simpanan-wajib' => SimpananWajibController::class,
        'pengeluaran' => PengeluaranController::class,
        'penjualan' => PenjualanController::class,
        'pemasukan' => PemasukanController::class,
        'pembelian' => PembelianController::class,
        'pemodal' => PemodalController::class,
        'pinjaman' => PinjamanController::class,
        'user' => UserController::class,
    ]);
});
