<?php

namespace App\Exports;

use App\Models\Anggaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class KrisarExport implements FromView
{
    protected $krisar;

    public function __construct($krisar)
    {
        $this->krisar = $krisar;
    }

    public function view(): View
    {
        return view('admin.exports.krisar', [
            'krisar' => $this->krisar
        ]);
    }
}
