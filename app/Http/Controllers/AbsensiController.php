<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiExport;
use App\Models\Absensi;
use App\Models\Auth;
use App\Models\Izin;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

        if (request('export') == 1) {
            $spreadsheet = new Spreadsheet();

            $sheet = $spreadsheet->getActiveSheet();

            $export = [
                ['Nama Siswa', 'NISN', 'Kelas', 'Koordinat Masuk', 'Tanggal Masuk', 'Koordinat Pulang', 'Tanggal Pulang', 'Keterangan'],
            ];

            foreach ($data['absensi'] as $item) {
                $export[] = [
                    $item->siswa->nama_siswa,
                    $item->siswa->nisn,
                    $item->siswa->kelas,
                    $item->lokasi_masuk,
                    $item->tanggal_masuk,
                    $item->lokasi_pulang,
                    $item->tanggal_pulang
                ];
            }

            $sheet->fromArray($export, null, 'A1');

            $writer = new Xlsx($spreadsheet);

            $filename = 'absensi.xlsx';
            $path = storage_path('app/' . $filename);
            $writer->save($path);

            return response()->download($path, $filename)->deleteFileAfterSend(true);
        }

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
        $siswa = Siswa::where('email_ortu', request('email_ortu'))->first();

        if (isset($siswa) && Hash::check(request('password_orangtua'), $siswa->password_orangtua)) {
            $data['siswa'] = $siswa;
            $data['izin'] = Izin::where('id_siswa', $siswa->id_siswa)->get();
            $data['absensi'] = Absensi::whereHas('siswa', function ($q) use ($siswa) {
                $q->where('id_siswa', $siswa->id_siswa);
            })->get();
            return view('pages.hasil', compact('data'));
        }

        return redirect()->back()->with('failed', 'email/password salah');
    }

    public function izinAcc()
    {
        Izin::where('id_izin', request('id_izin'))->update(['status' => 1]);
        return redirect()->back()->with('success', 'Izin berhasil disetujui');
    }

    public function izinSiswa()
    {
        $data['izin'] = Izin::get();
        return view('pages.izin', compact('data'));
    }

    public function izin()
    {
        $data =  request()->all();
        $file = request()->file('foto');
        $data['foto'] = $file->move('img/izin', $file->getClientOriginalName());
        Izin::create($data);
        return redirect()->back()->with('success', 'Izin berhasil');
    }
}
