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
        $already_nis = User::where('nisn', $row[2])->first();

        $tanggal = strtotime($row[5]);

        if (!$already_nis) {
            return new User([
                'nama' => $row[1],
                'nisn' => $row[2],
                'alamat' => $row[3],
                'jenis_kelamin' => $row[4],
                'tanggal_larhir' => date('Y-m-d', $tanggal)
            ]);
        } else {
            return;
        }
    }
}
