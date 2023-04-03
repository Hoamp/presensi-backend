<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminPrestasiController extends Controller
{
    public function lihat_prestasi()
    {
        // ambil semua prestasi
        $prestasi = Prestasi::with(['siswa'])->get();

        // jika prestasi kosong
        if (count($prestasi) == 0) {
            return response()->json([
                'success' => true,
                'message' => 'Belum ada prestasi pada siswa',
                'data' => []
            ], 200);
        } else {
            // jika ada, kembalikan response
            return response()->json([
                'success' => true,
                'message' => 'Semua data prestasi siswa',
                'data' => $prestasi
            ], 200);
        }
    }

    public function tambah_prestasi(Request $request)
    {
        // validasi
        $validator = Validator::make($request->all(), [
            // wajib terisi semuanya
            'prestasi' => 'required',
            'nilai' => 'required',
            'nisn' => 'required'
        ]);

        // jika ada yang kosong
        if ($validator->fails()) {
            // berikan pesan error
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambah prestasi',
                'error' => $validator->errors()
            ], 400);
        }

        // tambahkan prestasi
        $prestasi = Prestasi::create([
            'nisn' => $request->nisn,
            'nilai' => $request->nilai,
            'prestasi' => $request->prestasi
        ]);

        // jika berhasil menambah prestasi
        if ($prestasi) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menambah prestasi',
                'data' => $prestasi
            ], 201);
        } else {
            // jika gagal
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambah prestasi',
                'data' => []
            ], 400);
        }
    }

    public function ubah_prestasi(Request $request, $id)
    {
        // validasi
        $validator = Validator::make($request->all(), [
            // wajib terisi semuanya
            'prestasi' => 'required',
            'nilai' => 'required',
            'nisn' => 'required'
        ]);

        // jika ada yang kosong
        if ($validator->fails()) {
            // berikan pesan error
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengedit prestasi',
                'error' => $validator->errors()
            ], 400);
        }

        // cari prestasi berdasarkan id
        $prestasi = Prestasi::find($id);

        // update prestasi
        $berhasil = $prestasi->update([
            'nisn' => $request->nisn,
            'nilai' => $request->nilai,
            'prestasi' => $request->prestasi
        ]);

        // jika berhasil mengedit prestasi
        if ($berhasil) {
            return response()->json([
                'success' => $berhasil,
                'message' => 'Berhasil mengedit prestasi',
            ], 200);
        } else {
            // jika gagal
            return response()->json([
                'success' => $berhasil,
                'message' => 'Gagal mengedit prestasi',
            ], 400);
        }
    }

    public function hapus_prestasi($id)
    {
        // cari prestasi
        $prestasi = Prestasi::find($id);

        // hapus prestasi
        $prestasi->delete();

        // jika tidak ada
        if (!$prestasi) {
            return response()->json([
                'success' => false,
                'message' => 'Prestasi tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus prestasi',
            ], 200);
        }
    }
}
