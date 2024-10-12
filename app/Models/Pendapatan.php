<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendapatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'tgl_input',
        'sumber_dana',
        'jumlah_anggaran',
        'img',
    ];
}
