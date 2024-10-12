<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\Krisar;
use App\Models\Pembelanjaan;
use App\Models\Pendapatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $currentYear = date('Y');
        $filterYear = $request->input('tahun', $currentYear); // default ke tahun sekarang jika tidak ada filter

        $pendapatans = Pendapatan::whereYear('tgl_input', $filterYear)
            ->orderBy('tgl_input', 'desc')
            ->get();

        $anggarans = Anggaran::whereYear('tgl_input', $filterYear)
            ->orderBy('tgl_input', 'desc')
            ->get();

        $pembelanjaans = Pembelanjaan::whereYear('tgl_transaksi', $filterYear)
            ->orderBy('tgl_transaksi', 'desc')
            ->get();

        $laporans = DB::table('pendapatans')
            ->selectRaw('YEAR(tgl_input) as year,
                     SUM(jumlah_anggaran) as total_pendapatan,
                     (SELECT SUM(jumlah_anggaran) FROM pembelanjaans WHERE YEAR(tgl_transaksi) = year) as total_pembelanjaan,
                     (SUM(jumlah_anggaran) - (SELECT SUM(jumlah_anggaran) FROM pembelanjaans WHERE YEAR(tgl_transaksi) = year)) as surplus_defisit')
            ->whereYear('tgl_input', $filterYear)
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();

        // Mengirim data tahun yang tersedia untuk filter
        $availableYears = Pendapatan::selectRaw('YEAR(tgl_input) as year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get()
            ->pluck('year');

        return view('welcome', compact('pendapatans', 'anggarans', 'pembelanjaans', 'laporans', 'filterYear', 'availableYears'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'kritik' => 'required',
            'saran' => 'required',
        ]);

        $store = new Krisar();
        $store->nama = $request->nama;
        $store->email = $request->email;
        $store->kritik = $request->kritik;
        $store->saran = $request->saran;
        $store->save();
        return redirect()->back()->with('success', 'Terima Kasih ' . $request->nama . ' Telah Mengirimkan Kritik dan Saran');
    }
}
