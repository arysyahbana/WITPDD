<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnggaranExport;
use App\Http\Controllers\Controller;
use App\Models\Anggaran;
use App\Models\Bidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AnggaranController extends Controller
{
    private function validasiAnggaran(Request $request)
    {
        $request->validate(
            [
                'bidang' => 'required',
                'jumlah_anggaran' => 'required',
            ]
        );
    }

    public function index(Request $request)
    {
        $page = 'Anggaran';
        $query = Anggaran::query();

        // Cek apakah ada filter tahun
        if ($request->has('tahun') && $request->tahun != '') {
            $query->whereYear('tgl_input', $request->tahun);
        }
        $anggaran = $query->orderBy(DB::raw('YEAR(tgl_input)'), 'desc')
            ->orderBy('tgl_input', 'desc')
            ->get();
        $years = DB::table('anggarans')
            ->selectRaw('YEAR(tgl_input) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->get();

        return view('admin.anggaran.index', compact('page', 'anggaran', 'years'));
    }

    public function store(Request $request)
    {
        $this->validasiAnggaran($request);
        $data = [
            'tgl_input' => request('tgl_input'),
            'bidang' => request('bidang'),
            'jumlah_anggaran' => request('jumlah_anggaran'),
        ];
        $anggaran = Anggaran::create($data);
        if ($anggaran) {
            return redirect()->back()->with('success', 'Berhasil Menambahkan Data Anggaran');
        } else {
            return redirect()->back()->with('error', 'Gagal Menambahkan Data Anggaran');
        }
    }

    public function update(Request $request, $id)
    {
        $anggaran = Anggaran::findOrFail($id);

        $this->validasiAnggaran($request);

        $anggaran->update([
            'tgl_input' => $request->tgl_input,
            'bidang' => $request->bidang,
            'jumlah_anggaran' => $request->jumlah_anggaran,
        ]);

        return redirect()->back()->with('success', 'Berhasil Merubah Data Anggaran');
    }

    public function destroy($id)
    {
        $anggaran = Anggaran::findOrFail($id);
        $anggaran->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data Anggaran');
    }

    public function exportExcel(Request $request)
    {
        $tahun = $request->input('tahun');

        // Filter berdasarkan tahun created_at atau updated_at
        $anggaran = Anggaran::when($tahun, function ($query, $tahun) {
            $query->whereYear('tgl_input', $tahun);
        })->get();

        return Excel::download(new AnggaranExport($anggaran), 'anggaran_' . ($tahun ?? 'semua') . '.xlsx');
    }
}
