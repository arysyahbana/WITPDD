<?php

namespace App\Exports;

use App\Models\Pendapatan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PendapatanExport implements FromView
{
    protected $pendapatan;

    public function __construct($pendapatan)
    {
        $this->pendapatan = $pendapatan;
    }

    public function view(): View
    {
        return view('admin.exports.pendapatan', [
            'pendapatan' => $this->pendapatan
        ]);
    }
}
