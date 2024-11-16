<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\Krisar;
use App\Models\Pembelanjaan;
use App\Models\Pendapatan;
use Barryvdh\DomPDF\Facade\Pdf;
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
            'hp' => 'required',
            'kritik' => 'required',
            'saran' => 'required',
            'gambar' =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $store = new Krisar();
        $store->nama = $request->nama;
        $store->hp = $request->hp;
        $store->kritik = $request->kritik;
        $store->saran = $request->saran;

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = 'krisar_' . time() . '.' . $image->getClientOriginalExtension();

            // Define the path where images will be stored
            $path = public_path('dist/assets/img/krisar');

            // Create directory if it doesn't exist
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            // Move the image to the specified path
            $image->move($path, $imageName);

            // Save image name to database
            $store->gambar = $imageName;
        }

        $store->save();
        return redirect()->back()->with('success', 'Terima Kasih ' . $request->nama . ' Telah Mengirimkan Kritik dan Saran');
    }

    public function pdf_pendapatan(Request $request)
    {
        $currentYear = date('Y');
        $filterYear = $request->input('tahun', $currentYear);

        $pendapatans = Pendapatan::whereYear('tgl_input', $filterYear)
            ->orderBy('tgl_input', 'desc')
            ->get();

        // Passing data ke view PDF
        $data = [
            'pendapatans' => $pendapatans,
            'filterYear' => $filterYear
        ];

        // Generate PDF menggunakan view khusus
        $pdf = Pdf::loadView('admin.pdf.exportpdfpendapatan', $data);

        // Return file PDF untuk di-download
        return $pdf->download('pendapatan-' . $filterYear . '.pdf');
    }

    public function pdf_anggaran(Request $request)
    {
        $currentYear = date('Y');
        $filterYear = $request->input('tahun', $currentYear);

        $anggarans = Anggaran::whereYear('tgl_input', $filterYear)
            ->orderBy('tgl_input', 'desc')
            ->get();

        // Passing data ke view PDF
        $data = [
            'anggarans' => $anggarans,
            'filterYear' => $filterYear
        ];

        // Generate PDF menggunakan view khusus
        $pdf = Pdf::loadView('admin.pdf.exportpdfanggaran', $data);

        // Return file PDF untuk di-download
        return $pdf->download('anggaran-' . $filterYear . '.pdf');
    }

    public function pdf_pembelanjaan(Request $request)
    {
        $currentYear = date('Y');
        $filterYear = $request->input('tahun', $currentYear);

        $pembelanjaans = Pembelanjaan::whereYear('tgl_transaksi', $filterYear)
            ->orderBy('tgl_transaksi', 'desc')
            ->get();

        // Passing data ke view PDF
        $data = [
            'pembelanjaans' => $pembelanjaans,
            'filterYear' => $filterYear
        ];

        // Generate PDF menggunakan view khusus
        $pdf = Pdf::loadView('admin.pdf.exportpdfpembelanjaan', $data)->setPaper('a4', 'landscape');

        // Return file PDF untuk di-download
        return $pdf->download('pembelanjaan-' . $filterYear . '.pdf');
    }

    public function pdf_laporan(Request $request)
    {
        $currentYear = date('Y');
        $filterYear = $request->input('tahun', $currentYear);

        $laporans = DB::table('pendapatans')
            ->selectRaw('YEAR(tgl_input) as year,
                     SUM(jumlah_anggaran) as total_pendapatan,
                     (SELECT SUM(jumlah_anggaran) FROM pembelanjaans WHERE YEAR(tgl_transaksi) = year) as total_pembelanjaan,
                     (SUM(jumlah_anggaran) - (SELECT SUM(jumlah_anggaran) FROM pembelanjaans WHERE YEAR(tgl_transaksi) = year)) as surplus_defisit')
            ->whereYear('tgl_input', $filterYear)
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();

        // Passing data ke view PDF
        $data = [
            'laporans' => $laporans,
            'filterYear' => $filterYear
        ];

        // Generate PDF menggunakan view khusus
        $pdf = Pdf::loadView('admin.pdf.exportpdflaporan', $data);

        // Return file PDF untuk di-download
        return $pdf->download('laporan-' . $filterYear . '.pdf');
    }
}
