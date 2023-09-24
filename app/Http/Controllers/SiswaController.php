<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Auth;
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

    public function index()
    {
        if (Auth::user() && Auth::user()->wali_kelas != 'admin' && Auth::user()->wali_kelas) {
            $data['siswa'] = Siswa::where('kelas', Auth::user()->wali_kelas)->orderBy('id_siswa', 'desc')->get();
        } else {
            $data['siswa'] = Siswa::orderBy('nsin', 'asc')->get();
        }
        return view('pages.siswa', compact('data'));
    }

    public function store()
    {
        $data = request()->all();
        $data['password_siswa'] = Hash::make($data['password_siswa']);
        $data['password_orangtua'] = Hash::make($data['password_orangtua']);
        Siswa::create($data);
        return redirect()->back()->with('success', 'Siswa berhasil ditambahkan');
    }

    public function update()
    {
        $data = request()->except('_token', '_method', 'password_siswa', 'password_orangtua');
        if (request('password_siswa')) {
            $data['password_siswa'] = Hash::make($data['password_siswa']);
        }
        if (request('password_orangtua')) {
            $data['password_orangtua'] = Hash::make($data['password_orangtua']);
        }
        Siswa::where('nisn', $data['nisn'])->update($data);
        return redirect()->back()->with('success', 'Siswa berhasil diubah');
    }

    public function delete()
    {
        Siswa::where('nisn', request('nisn'))->delete();
        return redirect()->back()->with('success', 'Siswa berhasil dihapus');
    }
}
