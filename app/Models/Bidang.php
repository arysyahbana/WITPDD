<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;
    protected $fillable = [
        'bidang',
    ];

    public function rAnggaran()
    {
        return $this->hasMany(Anggaran::class);
    }
}
