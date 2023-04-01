<?php

use App\Http\Controllers\Api\AbsenController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// public route
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// private login route
Route::group(['middleware' => ['auth:sanctum']], function () {
    // logout user
    Route::post('/logout', [AuthController::class, 'logout']);

    // cek user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // route absen
    Route::get('/absen', [AbsenController::class, 'index']);
    Route::post('/absen', [AbsenController::class, 'store']);

    // route admin
    Route::group(['middleware' => ['is_admin']], function () {
    });
});
