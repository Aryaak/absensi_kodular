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

            return redirect()->route('index');
        }
        return redirect()->back()->with('error', 'ID/Password salah');
    }
}
