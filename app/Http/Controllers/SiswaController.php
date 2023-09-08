<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function login()
    {
        $siswa = Siswa::where('nisn', request('nisn'))->first();

        if (isset($siswa) && Hash::check(request('password'), $siswa->password_siswa)) {
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Login berhasil'
                ],
                'data' => $siswa
            ]);
        }

        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Login gagal'
            ],
            'data' => null
        ]);
    }

    public function absensi($nisn)
    {
        $siswa = Siswa::where('nisn', $nisn)->first();
        $absensi = Absensi::where('id_siswa', $siswa->id_siswa)->get();

        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Data absensi berhasil didapatkan'
            ],
            'data' => $absensi
        ]);
    }


    public function clockin()
    {
        $siswa = Siswa::where('nisn', request('nisn'))
            ->first();

        $absensi = Absensi::whereDate('tanggal_masuk', Carbon::today())
            ->where('id_siswa', $siswa->id_siswa)
            ->first();

        if ($absensi) {
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Clockin telah dilakukan'
                ],
                'data' => $absensi
            ]);
        } else {
            $file = request()->file('foto_masuk');

            Absensi::create([
                'id_siswa' => $siswa->id_siswa,
                'keterangan' => 'Masuk Kelas',
                'foto_masuk' => $file->move('img/masuk', $file->getClientOriginalName()),
                'lokasi_masuk' => request('lokasi_masuk'),
            ]);
        }

        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Clockin berhasil'
            ],
            'data' => null
        ]);
    }

    public function clockout()
    {
        $siswa = Siswa::where('nisn', request('nisn'))
            ->first();

        $absensi = Absensi::whereDate('tanggal_pulang', Carbon::today())
            ->where('id_siswa', $siswa->id_siswa)
            ->first();

        if ($absensi) {
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Clockout telah dilakukan'
                ],
                'data' => $absensi
            ]);
        } else {
            $absensi = Absensi::whereDate('tanggal_masuk', Carbon::today())
                ->where('id_siswa', $siswa->id_siswa)
                ->first();

            $file = request()->file('foto_pulang');

            Absensi::where('id_absensi', $absensi->id_absensi)
                ->update([
                    'id_siswa' => $siswa->id_siswa,
                    'keterangan' => 'Pulang',
                    'foto_pulang' => $file->move('img/pulang/', $file->getClientOriginalName()),
                    'lokasi_pulang' => request('lokasi_pulang'),
                    'tanggal_pulang' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
                ]);
        }

        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Clockout berhasil'
            ],
            'data' => null
        ]);
    }
}
