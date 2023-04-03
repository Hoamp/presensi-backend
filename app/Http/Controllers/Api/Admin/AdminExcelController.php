<?php

namespace App\Http\Controllers\Api\Admin;

use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminExcelController extends Controller
{
    public function export_excel()
    {
        return Excel::download(new UserExport, 'siswa.xlsx');
    }

    public function import_excel(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unique
        $namaFile = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di folder public
        $file->move('file_siswa', $namaFile);

        // import data ke db
        Excel::import(new SiswaImport, public_path('/file_siswa/' . $namaFile));

        // kembalikan response berhasil
        return response()->json([
            'success' => true,
            'message' => 'Sukses tambah data excel'
        ], 201);
    }
}
