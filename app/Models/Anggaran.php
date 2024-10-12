<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'tgl_input',
        'bidang',
        'jumlah_anggaran',
    ];

    // public function rBidang()
    // {
    //     return $this->belongsTo(Bidang::class, 'bidang_id');
    // }
}
