<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use PDO;

class Auth extends Model
{
    use HasFactory;


    public static function user()
    {
        return Guru::where('kode_guru', $_COOKIE['login'])->first();
    }
}
