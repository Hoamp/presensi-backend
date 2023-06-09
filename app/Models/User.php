<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use \App\Models\Absen;
use \App\Models\Prestasi;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'password',
        'alamat',
        'nisn',
        'tanggal_lahir',
        'jenis_kelamin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     
     protected $casts = [
         'email_verified_at' => 'datetime',
     ];
     */

    public function absensi()
    {
        return $this->hasMany(Absen::class);
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'nisn', 'nisn');
    }
}
