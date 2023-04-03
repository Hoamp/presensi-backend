<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Prestasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'prestasi',
        'nisn',
        'nilai'
    ];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'nisn', 'nisn');
    }
}
