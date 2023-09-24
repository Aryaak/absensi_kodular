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

        if (Auth::user() && Auth::user()->wali_kelas) {
            $wali_kelas = Auth::user()->wali_kelas;
            $data['absensi'] = $data['absensi']
                ->whereHas('siswa', function ($q) use ($wali_kelas) {
                    $q->where('kelas', $wali_kelas);
                });
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

    public function ortuHasil2()
    {
        $data['nisn'] = request('nisn');
        $data['siswa'] = Siswa::where('nisn', $data['nisn'])->first();
        $data['absensi'] = Absensi::orderBy('tanggal_masuk', 'DESC')
            ->whereHas('siswa', function ($q) use ($data) {
                $q->where('nisn', 'LIKE', '%' . $data['nisn'] . '%');
            })->get();

        return view('pages.hasil', compact('data'));
    }

    public function ortuHasil()
    {
        $siswa = Siswa::where('email_ortu', request('email_ortu'))->first();

        if (isset($siswa) && Hash::check(request('password_orangtua'), $siswa->password_orangtua)) {
            $data['siswa'] = $siswa;
            $data['absensi'] = Absensi::whereHas('siswa', function ($q) use ($siswa) {
                $q->where('id_siswa', $siswa->id_siswa);
            })->get();
            return view('pages.hasil', compact('data'));
        }

        return redirect()->back()->with('failed', 'email/password salah');
    }
}
