<?php

use App\Http\Controllers\Api\AbsenController;
use App\Http\Controllers\Api\Admin\AdminAbsenController;
use App\Http\Controllers\Api\Admin\AdminExcelController;
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

// Guest route
Route::group(['middleware' => ['guest']], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});


// Auth route
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
    Route::put('/absen/{id}', [AbsenController::class, 'update']);
    Route::get('/absen/{id}', [AbsenController::class, 'show']);

    // route admin
    Route::group(['middleware' => ['is_admin']], function () {
        // route menambah keterangan ke siswa
        Route::put('/keterangan/{id}', [AdminAbsenController::class, 'keterangan']);

        // route admin untuk menambah siswa dengan excel
        Route::get('/excel/export', [AdminExcelController::class, 'export_excel']);
        Route::post('/excel/import', [AdminExcelController::class, 'import_excel']);
    });
});
