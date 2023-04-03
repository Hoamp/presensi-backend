<?php

use App\Http\Controllers\Api\AbsenController;
use App\Http\Controllers\Api\Admin\AdminAbsenController;
use App\Http\Controllers\Api\Admin\AdminAcaraController;
use App\Http\Controllers\Api\Admin\AdminExcelController;
use App\Http\Controllers\Api\Admin\AdminPrestasiController;
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

/*
/------------------------------------------------------------------------ 
/ Route login
/------------------------------------------------------------------------ 
*/

Route::group(['middleware' => ['guest']], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});


/*
/------------------------------------------------------------------------ 
/ Route ketika sudah login
/------------------------------------------------------------------------ 
*/
Route::group(['middleware' => ['auth:sanctum']], function () {
    // logout user
    Route::post('/logout', [AuthController::class, 'logout']);

    // cek user
    Route::get('/user', [AuthController::class, 'get_user']);

    // route absen
    Route::get('/absen', [AbsenController::class, 'index']);
    Route::post('/absen', [AbsenController::class, 'store']);
    Route::put('/absen/{id}', [AbsenController::class, 'update']);
    Route::get('/absen/{id}', [AbsenController::class, 'show']);

    // siswa dan admin bisa melihat acara
    Route::get('/acara', [AdminAcaraController::class, 'lihat_acara']);
    Route::get('/acara/{id}', [AdminAcaraController::class, 'detail_acara']);

    /*
    /------------------------------------------------------------------------ 
    / Route Admin
    /------------------------------------------------------------------------ 
    */
    Route::group(['middleware' => ['is_admin']], function () {
        // route menambah keterangan ke siswa
        Route::put('/keterangan/{id}', [AdminAbsenController::class, 'keterangan']);

        // route admin untuk menambah siswa dengan excel
        Route::get('/excel/export', [AdminExcelController::class, 'export_excel']);
        Route::post('/excel/import', [AdminExcelController::class, 'import_excel']);

        // Route admin untuk crud prestasi siswa
        Route::get('/prestasi', [AdminPrestasiController::class, 'lihat_prestasi']);
        Route::post('/prestasi', [AdminPrestasiController::class, 'tambah_prestasi']);
        Route::put('/prestasi/{id}', [AdminPrestasiController::class, 'ubah_prestasi']);
        Route::delete('/prestasi/{id}', [AdminPrestasiController::class, 'hapus_prestasi']);

        // route admin untuk crud acara
        Route::post('/acara', [AdminAcaraController::class, 'tambah_acara']);
        Route::put('/acara/{id}', [AdminAcaraController::class, 'edit_acara']);
        Route::delete('/acara/{id}', [AdminAcaraController::class, 'hapus_acara']);
    });
});
