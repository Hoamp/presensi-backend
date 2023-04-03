<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // jika nisn sudah ada
        $already_nisn = User::where('nisn', $row[2])->first();

        // ubah string tanggal menjadi date
        $tanggal = strtotime($row[5]);

        // jika tidak ada nis yang sama
        if (!$already_nisn) {
            // masukkan ke dalam database
            return new User([
                'nama' => $row[1],
                'nisn' => $row[2],
                'alamat' => $row[3],
                'jenis_kelamin' => $row[4],
                'tanggal_larhir' => date('Y-m-d', $tanggal)
            ]);
        } else {
            // jika ada duplikasi nisn , skip baris
            return;
        }
    }
}
