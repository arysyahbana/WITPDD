<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelanjaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_transaksi',
        'uraian',
        'bidang_id',
        'pendapatan_id',
        'jumlah_anggaran',
        'img_transaksi',
        'img_kegiatan',
        'img_terealisasi',
        'status',
    ];

    public function rAnggaran()
    {
        return $this->belongsTo(Anggaran::class, 'anggaran_id', 'id');
    }

    public function rPendapatan()
    {
        return $this->belongsTo(Pendapatan::class, 'pendapatan_id', 'id');
    }
}
