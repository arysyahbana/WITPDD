<?php

namespace App\Exports;

use App\Models\Anggaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AnggaranExport implements FromView
{
    protected $anggaran;

    public function __construct($anggaran)
    {
        $this->anggaran = $anggaran;
    }

    public function view(): View
    {
        return view('admin.exports.anggaran', [
            'anggaran' => $this->anggaran
        ]);
    }
}
