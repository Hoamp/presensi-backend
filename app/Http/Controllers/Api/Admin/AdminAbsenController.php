<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminAbsenController extends Controller
{
    public function keterangan(Request $request, $id)
    {
        // validasi inputan keterangan
        $validator = Validator::make($request->all(), [
            'keterangan' => 'required',
            'tanggal' => 'required',
            'user_id' => 'required'
        ]);

        // jika gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambah keterangan',
                'error' => $validator->errors()
            ], 400);
        }

        // cari absen yang ada id tersebut
        $absen = Absen::find($id);

        // jika tidak ada absen 
        if (!$absen) {
            Absen::create([
                'masuk' => '',
                'user_id' => $request->user_id,
                'pulang' => '',
                'keterangan' => $request->keterangan,
                'tanggal' => $request->tanggal
            ]);

            // return response
            return response()->json([
                'success' => true,
                'message' => "Berhasil tambah keterangan"
            ], 200);
        } else {
            // jika ada absen
            $absen->update([
                'keterangan' => $request->keterangan
            ]);


            // return response
            return response()->json([
                'success' => true,
                'message' => "Berhasil tambah keterangan"
            ], 200);
        }
    }
}
