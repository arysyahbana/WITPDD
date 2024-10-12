<?php

namespace App\Http\Controllers\Admin;

use App\Exports\LaporanKeuanganExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LaporanKeuanganController extends Controller
{
    public function index(Request $request)
    {
        $page = 'Laporan';

        // Ambil daftar tahun dari pendapatan dan pembelanjaan
        $years = DB::table('pendapatans')
            ->selectRaw('YEAR(tgl_input) as year')
            ->union(
                DB::table('pembelanjaans')
                    ->selectRaw('YEAR(tgl_transaksi) as year')
            )
            ->distinct()
            ->orderBy('year', 'desc')
            ->get();

        // Filter data berdasarkan tahun yang dipilih
        $laporan = DB::table('pendapatans')
            ->selectRaw('YEAR(tgl_input) as year,
                     SUM(jumlah_anggaran) as total_pendapatan')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->when($request->tahun, function ($query, $tahun) {
                $query->having('year', $tahun);
            })
            ->get()
            ->map(function ($item) {
                $totalPembelanjaan = DB::table('pembelanjaans')
                    ->whereYear('tgl_transaksi', $item->year)
                    ->sum('jumlah_anggaran');

                $item->total_pembelanjaan = $totalPembelanjaan;
                $item->surplus_defisit = $item->total_pendapatan - $totalPembelanjaan;

                return $item;
            });

        return view('admin.laporan.index', compact('page', 'laporan', 'years'));
    }

    public function exportExcel(Request $request)
    {
        $tahun = $request->input('tahun');

        // Filter berdasarkan tahun created_at atau updated_at
        $laporan = DB::table('pendapatans')
            ->selectRaw('YEAR(tgl_input) as year,
                     SUM(jumlah_anggaran) as total_pendapatan')
            ->groupBy('year')
            ->when($tahun, function ($query) use ($tahun) {
                $query->having('year', $tahun);
            })
            ->get()
            ->map(function ($item) {
                $totalPembelanjaan = DB::table('pembelanjaans')
                    ->whereYear('tgl_transaksi', $item->year)
                    ->sum('jumlah_anggaran');

                $item->total_pembelanjaan = $totalPembelanjaan;
                $item->surplus_defisit = $item->total_pendapatan - $totalPembelanjaan;

                return $item;
            });

        // Tentukan nama file berdasarkan filter tahun
        $fileName = $tahun ? 'laporan_keuangan_' . $tahun . '.xlsx' : 'laporan_keuangan_semua.xlsx';

        return Excel::download(new LaporanKeuanganExport($laporan), $fileName);
    }
}
