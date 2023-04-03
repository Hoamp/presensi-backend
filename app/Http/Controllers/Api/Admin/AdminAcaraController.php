<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Acara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminAcaraController extends Controller
{
    public function lihat_acara()
    {
        // ambil semua acara
        $acara = Acara::all();

        // jika acara kosong
        if (count($acara) == 0) {
            return response()->json([
                'success' => true,
                'message' => 'Belum ada acara',
                'data' => []
            ], 200);
        } else {
            // jika ada, kembalikan response
            return response()->json([
                'success' => true,
                'message' => 'Semua data acara',
                'data' => $acara
            ], 200);
        }
    }

    public function detail_acara($id)
    {
        // cari acara berdasarkan id
        $acara = Acara::find($id);

        // jika ada acara ditemukan
        if ($acara) {
            // kembalikan response sesuai id
            return response()->json([
                'success' => true,
                'message' => 'Detail data acara',
                'data' => $acara
            ], 200);
        } else {
            // jika tidak ada
            return response()->json([
                'success' => false,
                'message' => 'Acara tidak ditemukan',
                'data' => []
            ], 200);
        }
    }

    public function tambah_acara(Request $request)
    {
        // validasi
        $validator = Validator::make($request->all(), [
            // wajib terisi semuanya
            'tanggal' => 'required',
            'acara' => 'required',
            'detail' => 'required'
        ]);

        // jika ada yang kosong
        if ($validator->fails()) {
            // berikan pesan error
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambah acara',
                'error' => $validator->errors()
            ], 400);
        }

        // tambahkan acara
        $acara = Acara::create([
            'tanggal' => $request->tanggal,
            'detail' => $request->detail,
            'acara' => $request->acara
        ]);

        // jika berhasil menambah acara
        if ($acara) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menambah acara',
                'data' => $acara
            ], 201);
        } else {
            // jika gagal
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambah acara',
                'data' => []
            ], 400);
        }
    }

    public function edit_acara(Request $request, $id)
    {
        // validasi
        $validator = Validator::make($request->all(), [
            // wajib terisi semuanya
            'acara' => 'required',
            'tanggal' => 'required',
            'detail' => 'required'
        ]);

        // jika ada yang kosong
        if ($validator->fails()) {
            // berikan pesan error
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah acara',
                'error' => $validator->errors()
            ], 400);
        }

        // cari acara berdasarkan id
        $acara = Acara::find($id);

        // update acara
        $berhasil = $acara->update([
            'tanggal' => $request->tanggal,
            'detail' => $request->detail,
            'acara' => $request->acara
        ]);

        // jika berhasil mengedit acara
        if ($berhasil) {
            return response()->json([
                'success' => $berhasil,
                'message' => 'Berhasil mengedit acara',
            ], 200);
        } else {
            // jika gagal
            return response()->json([
                'success' => $berhasil,
                'message' => 'Gagal mengedit acara',
            ], 400);
        }
    }

    public function hapus_acara($id)
    {
        // cari acara
        $acara = Acara::find($id);

        // hapus acara
        $acara->delete();

        // jika tidak ada
        if (!$acara) {
            return response()->json([
                'success' => true,
                'message' => 'Acara tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus acara',
            ], 200);
        }
    }
}
