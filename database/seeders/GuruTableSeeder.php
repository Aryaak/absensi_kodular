<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GuruTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Guru::create([
            'id_guru' => 1,
            'kode_guru' => 01111,
            'nama_guru' => 'Teacher Tiara Indra',
            'password' => Hash::make('password')
        ]);
        Guru::create([
            'id_guru' => 2,
            'kode_guru' => 02222,
            'nama_guru' => 'Teacher Alex Smith',
            'password' => Hash::make('password2')
        ]);
        Guru::create([
            'id_guru' => 3,
            'kode_guru' => 03333,
            'nama_guru' => 'Teacher Emily Davis',
            'password' => Hash::make('password3')
        ]);
        Guru::create([
            'id_guru' => 4,
            'kode_guru' => 04444,
            'nama_guru' => 'Teacher John Doe',
            'password' => Hash::make('password4')
        ]);
    }
}
