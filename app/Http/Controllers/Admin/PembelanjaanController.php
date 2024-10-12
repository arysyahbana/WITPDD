<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PembelanjaanExport;
use App\Http\Controllers\Controller;
use App\Models\Anggaran;
use App\Models\Pembelanjaan;
use App\Models\Pendapatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class PembelanjaanController extends Controller
{
    private function validasiPembelanjaan(Request $request, $imageRule)
    {
        $request->validate(
            [
                'tgl_transaksi' => 'required',
                'uraian' => 'required',
                'anggaran_id' => 'required',
                'pendapatan_id' => 'required',
                'jumlah_anggaran' => 'required',
                'img_transaksi' => $imageRule . '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'img_terealisasi' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'tgl_transaksi.required' => 'Tanggal transaski wajib diisi',
                'uraian.required' => 'Uraian wajib diisi',
                'anggaran_id.required' => 'Bidang wajib diisi',
                'pendapatan_id.required' => 'Sumber Dana wajib diisi',
                'jumlah_anggaran.required' => 'Jumlah Anggaran wajib diisi',
                'img_transaksi.required' => 'Bukti Transaksi wajib diisi',
                'img_transaksi.image' => 'Bukti Transaksi harus berupa gambar',
                'img_transaksi.mimes' => 'Bukti Transaksi harus berupa jpeg, png, jpg, gif, svg',
                'img_transaksi.max' => 'Bukti Transaksi tidak boleh lebih dari 2 MB',
                'img_terealisasi.image' => 'Bukti Terealisasi harus berupa gambar',
                'img_terealisasi.mimes' => 'Bukti Terealisasi harus berupa jpeg, png, jpg, gif, svg',
                'img_terealisasi.max' => 'Bukti Terealisasi tidak boleh lebih dari 2 MB',
            ],
        );
    }

    private function getImage($image, $name)
    {
        if ($image == null) {
            return null;
        }
        $extension = $image->getClientOriginalExtension();
        $filename = $name . '.' . $extension;
        // Mengatur folder penyimpanan sesuai jenis gambar
        $directory = '';
        if (strpos($name, 'transaksi_') === 0) {
            $directory = 'transaksi';
        } elseif (strpos($name, 'terealisasi_') === 0) {
            $directory = 'terealisasi';
        }
        $path = public_path('dist/assets/img/' . $directory);
        $image->move($path, $filename);
        return $filename;
    }

    private function deleteImage($folder, $filename)
    {
        $path = public_path("dist/assets/img/$folder/$filename");

        if (is_file($path) && file_exists($path)) {
            unlink($path);
        }
    }


    public function index(Request $request)
    {
        $page = 'Pembelanjaan';
        $anggarans = Anggaran::all();
        $pendapatans = Pendapatan::all();

        $query = Pembelanjaan::query();
        // Cek apakah ada filter tahun
        if ($request->has('tahun') && $request->tahun != '') {
            $query->whereYear('tgl_transaksi', $request->tahun);
        }
        $pembelanjaans = $query->orderBy(DB::raw('YEAR(tgl_transaksi)'), 'desc')
            ->orderBy('tgl_transaksi', 'desc')
            ->get();

        $years = DB::table('pembelanjaans')
            ->selectRaw('YEAR(tgl_transaksi) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->get();
        return view('admin.pembelanjaan.index', compact('page', 'anggarans', 'pendapatans', 'pembelanjaans', 'years'));
    }

    public function store(Request $request)
    {
        $this->validasiPembelanjaan($request, 'required');

        $store = new Pembelanjaan();
        $store->tgl_transaksi = $request->input('tgl_transaksi');
        $store->uraian = $request->input('uraian');
        $store->anggaran_id = $request->input('anggaran_id');
        $store->pendapatan_id = $request->input('pendapatan_id');
        $store->jumlah_anggaran = $request->input('jumlah_anggaran');
        $store->img_transaksi = $this->getImage($request->file('img_transaksi'), 'transaksi_' . Str::uuid());
        $store->img_terealisasi = $this->getImage($request->file('img_terealisasi'), 'terealisasi_' . Str::uuid());

        if ($store->img_terealisasi == null) {
            $store->status = 'Sedang Berjalan';
        } else {
            $store->status = 'Terlaksana';
        }

        $store->save();

        if ($store) {
            return redirect()->back()->with('success', 'Berhasil Menambahkan Data Transaski');
        } else {
            return redirect()->back()->with('error', 'Gagal Menambahkan Data Transaski');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validasiPembelanjaan($request, 'sometimes');

        $update = Pembelanjaan::findOrFail($id);
        $update->tgl_transaksi = $request->input('tgl_transaksi');
        $update->uraian = $request->input('uraian');
        $update->anggaran_id = $request->input('anggaran_id');
        $update->pendapatan_id = $request->input('pendapatan_id');
        $update->jumlah_anggaran = $request->input('jumlah_anggaran');

        if ($request->hasFile('img_transaksi')) {
            $this->deleteImage('transaksi', $update->img_transaksi);
            $update->img_transaksi = $this->getImage($request->file('img_transaksi'), 'transaksi_' . Str::uuid());
        }
        if ($request->hasFile('img_terealisasi')) {
            $this->deleteImage('terealisasi', $update->img_terealisasi);
            $update->img_terealisasi = $this->getImage($request->file('img_terealisasi'), 'terealisasi_' . Str::uuid());
        }

        if ($update->img_terealisasi == null) {
            $update->status = 'Sedang Berjalan';
        } else {
            $update->status = 'Terlaksana';
        }

        $update->save();

        if ($update) {
            return redirect()->back()->with('success', 'Berhasil Merubah Data Transaski');
        } else {
            return redirect()->back()->with('error', 'Gagal Merubah Data Transaski');
        }
    }

    public function destroy($id)
    {
        $delete = Pembelanjaan::findOrFail($id);

        $this->deleteImage('transaksi', $delete->img_transaksi);
        $this->deleteImage('terealisasi', $delete->img_terealisasi);

        $delete->delete();
        return redirect()->back()->with('success', 'Data pembelanjaan berhasil dihapus.');
    }

    public function exportExcel(Request $request)
    {
        $tahun = $request->input('tahun');

        // Filter berdasarkan tahun created_at atau updated_at
        $pembelanjaan = Pembelanjaan::when($tahun, function ($query, $tahun) {
            $query->whereYear('tgl_transaksi', $tahun);
        })->get();

        return Excel::download(new PembelanjaanExport($pembelanjaan), 'pembelanjaan_' . ($tahun ?? 'semua') . '.xlsx');
    }
}
