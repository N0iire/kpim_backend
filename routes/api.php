<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SimpananWajibController;
use App\Http\Controllers\SimpananSukarelaController;
use App\Http\Controllers\SimpananPokokController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Route for User
 */
Route::resource('user', UserController::class);

/**
 * Route for Simpanan Wajib
 */
Route::resource('simpanan-wajib', SimpananWajibController::class);

/**
 * Route for Simpanan Sukarela
 */
Route::resource('simpanan-sukarela', SimpananSukarelaController::class);

/**
 * Route for Simpanan Pokok
 */
Route::resource('simpanan-pokok', SimpananPokokController::class);
