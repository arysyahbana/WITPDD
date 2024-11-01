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
                'img_kegiatan' => 'nullable|array',
                'img_kegiatan.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
                'img_kegiatan.array' => 'Gambar harus dalam format array',
                'img_kegiatan.*.image' => 'Setiap file harus berupa gambar',
                'img_kegiatan.*.max' => 'Setiap gambar maksimal 2MB',
                'img_kegiatan.*.mimes' => 'Setiap gambar harus berupa jpeg, png, jpg, gif, atau svg',
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
        } elseif (strpos($name, 'kegiatan') === 0) {
            $directory = 'kegiatan';
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

        $imgKegiatans = $request->file('img_kegiatan');
        if (!is_array($imgKegiatans)) {
            $imgKegiatans = explode(',', $imgKegiatans);
        }

        $savedImgKegiatans = [];

        if (is_array($imgKegiatans)) {
            foreach ($imgKegiatans as $index => $image) {
                $savedImgKegiatans[] = $this->getImage($image, 'kegiatan_' . $store->tgl_transaksi . '_' . ($index + 1));
            }
        }

        $imgKegiatan = implode(',', $savedImgKegiatans);
        $store->img_kegiatan = $imgKegiatan;

        $store->img_terealisasi = $this->getImage($request->file('img_terealisasi'), 'terealisasi_' . Str::uuid());

        $store->status = $store->img_terealisasi ? 'Terlaksana' : 'Sedang Berjalan';

        $store->save();

        if ($store) {
            return redirect()->back()->with('success', 'Berhasil Menambahkan Data Pembelanjaan');
        } else {
            return redirect()->back()->with('error', 'Gagal Menambahkan Data Pembelanjaan');
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

        // Update img_transaksi
        if ($request->hasFile('img_transaksi')) {
            $this->deleteImage('transaksi', $update->img_transaksi);
            $update->img_transaksi = $this->getImage($request->file('img_transaksi'), 'transaksi_' . Str::uuid());
        }

        // Update img_terealisasi
        if ($request->hasFile('img_terealisasi')) {
            $this->deleteImage('terealisasi', $update->img_terealisasi);
            $update->img_terealisasi = $this->getImage($request->file('img_terealisasi'), 'terealisasi_' . Str::uuid());
        }

        // Update img_kegiatan
        if ($request->hasFile('img_kegiatan')) {
            // Delete old img_kegiatan
            $oldImages = explode(',', $update->img_kegiatan);
            foreach ($oldImages as $oldImage) {
                $this->deleteImage('kegiatan', $oldImage);
            }

            // Save new img_kegiatan
            $imgKegiatans = $request->file('img_kegiatan');
            $savedImgKegiatans = [];

            foreach ($imgKegiatans as $index => $image) {
                $savedImgKegiatans[] = $this->getImage($image, 'kegiatan_' . $update->tgl_transaksi . '_' . ($index + 1));
            }

            $update->img_kegiatan = implode(',', $savedImgKegiatans);
        }

        // Update status
        $update->status = $update->img_terealisasi ? 'Terlaksana' : 'Sedang Berjalan';

        $update->save();

        if ($update) {
            return redirect()->back()->with('success', 'Berhasil Merubah Data Pembelanjaan');
        } else {
            return redirect()->back()->with('error', 'Gagal Merubah Data Pembelanjaan');
        }
    }

    public function destroy($id)
    {
        $delete = Pembelanjaan::findOrFail($id);

        // Delete img_transaksi and img_terealisasi
        $this->deleteImage('transaksi', $delete->img_transaksi);
        $this->deleteImage('terealisasi', $delete->img_terealisasi);

        // Delete img_kegiatan
        $imgKegiatans = explode(',', $delete->img_kegiatan);
        foreach ($imgKegiatans as $image) {
            $this->deleteImage('kegiatan', $image);
        }

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
