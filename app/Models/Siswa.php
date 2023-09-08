<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa',
        $primaryKey = 'id_siswa',
        $guarded = [];

    public $timestamps = false;
}
