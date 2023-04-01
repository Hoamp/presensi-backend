<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\User;

class Absen extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'masuk',
        'pulang',
        'keterangan',
        'user_id'
    ];

    public function siswa()
    {
        return $this->belongsTo(User::class);
    }
}
