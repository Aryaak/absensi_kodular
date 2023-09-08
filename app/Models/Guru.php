<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru',
        $primaryKey = 'id_guru',
        $guarded = [];

    public $timestamps = false;
}
