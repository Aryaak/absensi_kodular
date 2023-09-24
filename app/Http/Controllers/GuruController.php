<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function login()
    {
        return view('pages.login');
    }

    public function logout()
    {
        unset($_COOKIE['login']);
        setcookie('login', null, -1, '/');

        return redirect()->back();
    }

    public function loginCheck()
    {

        $data = Guru::where('kode_guru', request('kode_guru'))->first();

        if (isset($data) && Hash::check(request('password'), $data->password)) {
            setcookie(
                "login",
                $data->kode_guru,
                time() + (10 * 365 * 24 * 60 * 60),
                "/"
            );

            if ($data->wali_kelas == 'admin') {
                return redirect()->route('siswa.index');
            }
            return redirect()->route('index');
        }
        return redirect()->back()->with('error', 'ID/Password salah');
    }

    public function index()
    {
        $data['guru'] = Guru::orderBy('id_guru', 'desc')->get();
        return view('pages.guru', compact('data'));
    }

    public function store()
    {
        $data = request()->all();
        $data['password'] = Hash::make($data['password']);
        Guru::create($data);
        return redirect()->back()->with('success', 'Guru berhasil ditambahkan');
    }

    public function update()
    {
        $data = request()->except('_token', '_method', 'password');
        if (request('password')) {
            $data['password'] = Hash::make($data['password']);
        }

        Guru::where('id_guru', $data['id_guru'])->update($data);
        return redirect()->back()->with('success', 'Guru berhasil diubah');
    }

    public function delete()
    {
        Guru::where('id_guru', request('id_guru'))->delete();
        return redirect()->back()->with('success', 'Guru berhasil dihapus');
    }
}
