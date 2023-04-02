<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'nama' => 'admin',
            'nisn' => '999999',
            'password' => bcrypt('admin'),
            'alamat' => 'wates',
            'jenis_kelamin' => 'laki-laki',
            'tanggal_lahir' => '2006-03-24',
            'role' => 'admin'
        ]);
    }
}
