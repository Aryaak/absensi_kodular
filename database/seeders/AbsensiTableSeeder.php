<?php

namespace Database\Seeders;

use App\Models\Absensi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AbsensiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Absensi::create([
            'id_absensi' => 1,
            'id_siswa' => 1,
            'keterangan' => 'Masuk Kelas',
            'foto_masuk' => 'img/masuk/1.jpg',
            'foto_pulang' => 'img/pulang/1.jpg',
            'lokasi_masuk' => '-7.25525344825327, 112.75584425506926',
            'lokasi_pulang' => '-7.2560729534311585, 112.75394525117328',
            'tanggal_masuk' => '2023-09-04 07:00:00',
            'tanggal_pulang' => NOW()
        ]);
        Absensi::create([
            'id_absensi' => 2,
            'id_siswa' => 2,
            'keterangan' => 'Masuk Kelas',
            'foto_masuk' => 'img/masuk/2.jpg',
            'foto_pulang' => 'img/pulang/2.jpg',
            'lokasi_masuk' => '-7.25525344825327, 112.75584425506926',
            'lokasi_pulang' => '-7.2560729534311585, 112.75394525115328',
            'tanggal_masuk' => '2023-09-04 07:00:00',
            'tanggal_pulang' => '2023-09-04 16:00:00'
        ]);
        Absensi::create([
            'id_absensi' => 3,
            'id_siswa' => 3,
            'keterangan' => 'Masuk Kelas',
            'foto_masuk' => 'img/masuk/3.jpg',
            'foto_pulang' => 'img/pulang/3.jpg',
            'lokasi_masuk' => '-7.25525344825327, 112.75584425506926',
            'lokasi_pulang' => '-7.2560729534311585, 112.75394525147328',
            'tanggal_masuk' => '2023-09-04 07:00:00',
            'tanggal_pulang' => '2023-09-04 16:00:00'
        ]);
        Absensi::create([
            'id_absensi' => 4,
            'id_siswa' => 4,
            'keterangan' => 'Masuk Kelas',
            'foto_masuk' => 'img/masuk/4.jpg',
            'foto_pulang' => 'img/pulang/4.jpg',
            'lokasi_masuk' => '-7.25525344825327, 112.75584425506926',
            'lokasi_pulang' => '-7.2560729534311585, 112.75394524117328',
            'tanggal_masuk' => '2023-09-04 07:00:00',
            'tanggal_pulang' => '2023-09-04 16:00:00'
        ]);
        Absensi::create([
            'id_absensi' => 5,
            'id_siswa' => 5,
            'keterangan' => 'Masuk Kelas',
            'foto_masuk' => 'img/masuk/5.jpg',
            'foto_pulang' => 'img/pulang/5.jpg',
            'lokasi_masuk' => '-7.25525344825327, 112.75584425506926',
            'lokasi_pulang' => '-7.2560729534311585, 112.75394522117328',
            'tanggal_masuk' => '2023-09-04 07:00:00',
            'tanggal_pulang' => '2023-09-04 16:00:00'
        ]);
        Absensi::create([
            'id_absensi' => 6,
            'id_siswa' => 6,
            'keterangan' => 'Masuk Kelas',
            'foto_masuk' => 'img/masuk/6.jpg',
            'foto_pulang' => 'img/pulang/6.jpg',
            'lokasi_masuk' => '-7.25525344825327, 112.75584425506926',
            'lokasi_pulang' => '-7.2560729534311585, 112.75394521117328',
            'tanggal_masuk' => '2023-09-04 07:00:00',
            'tanggal_pulang' => '2023-09-04 16:00:00'
        ]);
    }
}
