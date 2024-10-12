<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanKeuanganExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $laporan;

    public function __construct($laporan)
    {
        $this->laporan = $laporan;
    }

    public function collection()
    {
        return $this->laporan->map(function ($item) {
            return [
                $item->year,
                $item->total_pendapatan,
                $item->total_pembelanjaan,
                $item->surplus_defisit,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Tahun',
            'Jumlah Pendapatan',
            'Jumlah Pembelanjaan',
            'Surplus/Defisit',
        ];
    }
}
