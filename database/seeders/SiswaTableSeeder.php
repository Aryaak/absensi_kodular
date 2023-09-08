<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SiswaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::create([
            'id_siswa' => 1,
            'nama_siswa' => 'Craig Westervelt',
            'password_siswa' => Hash::make('password'),
            'nisn' => 132017100745,
            'kelas' => '12-A',
            'alamat' => 'Surabaya, Jawa Timur',
            'nama_ortu' => 'Ortu Craig Westervelt',
            'email_ortu' => 'ortu.craig@gmail.com',
            'password_orangtua' => Hash::make('password')
        ]);
        Siswa::create([
            'id_siswa' => 2,
            'nama_siswa' => 'Zain George',
            'password_siswa' => Hash::make('password'),
            'nisn' => 132017100751,
            'kelas' => '12-A',
            'alamat' => 'Surabaya, Jawa Timur',
            'nama_ortu' => 'Ortu Zain George',
            'email_ortu' => 'ortu.zain@gmail.com',
            'password_orangtua' => Hash::make('password')
        ]);
        Siswa::create([
            'id_siswa' => 3,
            'nama_siswa' => 'Kaiya Geidt',
            'password_siswa' => Hash::make('password'),
            'nisn' => 132017100744,
            'kelas' => '12-A',
            'alamat' => 'Surabaya, Jawa Timur',
            'nama_ortu' => 'Ortu Kaiya Geidt',
            'email_ortu' => 'ortu.kaiya@gmail.com',
            'password_orangtua' => Hash::make('password')
        ]);
        Siswa::create([
            'id_siswa' => 4,
            'nama_siswa' => 'Tiara Indra Arifien',
            'password_siswa' => Hash::make('password'),
            'nisn' => 132017100613,
            'kelas' => '12-A',
            'alamat' => 'Surabaya, Jawa Timur',
            'nama_ortu' => 'Ortu Tiara Indra Arifien',
            'email_ortu' => 'ortu.tiara@gmail.com',
            'password_orangtua' => Hash::make('password')
        ]);
        Siswa::create([
            'id_siswa' => 5,
            'nama_siswa' => 'Ellijah Ntare Zachary',
            'password_siswa' => Hash::make('password'),
            'nisn' => 132017100745,
            'kelas' => '12-A',
            'alamat' => 'Surabaya, Jawa Timur',
            'nama_ortu' => 'Ortu Ellijah Ntare Zachary',
            'email_ortu' => 'ortu.ellijah@gmail.com',
            'password_orangtua' => Hash::make('password')
        ]);
    }
}
