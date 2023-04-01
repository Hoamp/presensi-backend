<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbsenController extends Controller
{
    public function index()
    {
        return User::with(['absensi'])->get();
    }
    public function store(Request $request)
    {
        // buat absen baru
        $absen = Absen::create([
            'masuk' => Carbon::now()->toTimeString(),
            'user_id' => auth()->user()->id,
            'pulang' => '',
            'keterangan' => '',
            'tanggal' => Carbon::now()
        ]);

        // cek jika berhasil
        if ($absen) {
            // kembalikan response sukses
            return response()->json([
                'success' => true,
                'message' => 'Sukses absen',
                'data' => $absen
            ], 201);
        } else {
            // jika gagal
            return response()->json([
                'success' => false,
                'message' => 'Gagal absen',
            ], 400);
        }
    }
}
