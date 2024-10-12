<?php

namespace App\Exports;

use App\Models\Pembelanjaan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class PembelanjaanExport implements FromView
{
    protected $pembelanjaan;

    public function __construct($pembelanjaan)
    {
        $this->pembelanjaan = $pembelanjaan;
    }

    public function view(): View
    {
        return view('admin.exports.pembelanjaan', [
            'pembelanjaan' => $this->pembelanjaan
        ]);
    }
}
