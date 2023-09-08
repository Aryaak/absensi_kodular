<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Auth;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AbsensiController extends Controller
{
    public function index()
    {
        $data['keyword'] = request('keyword');
        $data['nisn'] = request('nisn');
        $data['date_from'] = request('date_from');
        $data['date_to'] = request('date_to');
        $data['nama'] = request('nama');
        $data['kelas'] = request('kelas');
        $data['keterangan'] = request('keterangan');

        $data['absensi'] = Absensi::orderBy('tanggal_masuk', 'DESC')
            ->whereHas('siswa', function ($q) use ($data) {
                $q->where('nama_siswa', 'LIKE', '%' . $data['keyword'] . '%');
            });

        $data['absensi'] = $data['absensi']
            ->whereHas('siswa', function ($q) use ($data) {
                $q->where('nama_siswa', 'LIKE', '%' . $data['keyword'] . '%');
            });

        $data['absensi'] = $data['absensi']
            ->whereHas('siswa', function ($q) use ($data) {
                $q->where('nisn', 'LIKE', '%' . $data['nisn'] . '%');
            });

        $data['absensi'] = $data['absensi']
            ->whereHas('siswa', function ($q) use ($data) {
                $q->where('nama_siswa', 'LIKE', '%' . $data['nama'] . '%');
            });

        $data['absensi'] = $data['absensi']
            ->whereHas('siswa', function ($q) use ($data) {
                $q->where('kelas', 'LIKE', '%' . $data['kelas'] . '%');
            });

        $data['absensi'] = $data['absensi']->where('keterangan', 'LIKE', '%' . $data['keterangan'] . '%');

        if ($data['date_from'] && $data['date_to']) {
            $data['absensi'] = $data['absensi']->where('tanggal_masuk', '>=', $data['date_from'])
                ->where('tanggal_masuk', '<=', $data['date_to']);
        }

        $data['absensi'] = $data['absensi']->get();

        return view('pages.index', compact('data'));
    }

    public function update(Absensi $absensi)
    {
        $absensi->update([
            'keterangan' => request('keterangan')
        ]);
        return redirect()->back();
    }


    public function ortu()
    {
        return view('pages.ortu');
    }

    public function ortuHasil()
    {
        $data['nisn'] = request('nisn');
        $data['siswa'] = Siswa::where('nisn', $data['nisn'])->first();
        $data['absensi'] = Absensi::orderBy('tanggal_masuk', 'DESC')
            ->whereHas('siswa', function ($q) use ($data) {
                $q->where('nisn', 'LIKE', '%' . $data['nisn'] . '%');
            })->get();

        return view('pages.hasil', compact('data'));
    }
}
