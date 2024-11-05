<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PendapatanExport;
use App\Http\Controllers\Controller;
use App\Models\Pendapatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PendapatanController extends Controller
{
    private function validasiPendapatan(Request $request, $imageRule)
    {
        $request->validate(
            [
                'tgl_input' => 'required',
                'sumber_dana' => 'required',
                'jumlah_anggaran' => 'required',
                'img' => $imageRule . '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]
        );
    }

    private function getImage($image, $name, $directory = '')
    {
        if ($image == null) {
            return null;
        }
        $extension = $image->getClientOriginalExtension();

        $timestamp = date('Ymd_His');
        $filename = preg_replace('/\s+/', '_', $name) . '_' . $timestamp . '.' . $extension;

        $path = public_path('dist/assets/img/pendapatan/' . $directory);
        $image->move($path, $filename);
        return $filename;
    }

    private function deleteImage($folder, $filename)
    {
        $path = public_path("dist/assets/img/$folder/$filename");
        if (file_exists($path)) {
            unlink($path);
        }
    }

    public function index(Request $request)
    {
        $page = 'Pendapatan';
        $query = Pendapatan::query();

        // Cek apakah ada filter tahun
        if ($request->has('tahun') && $request->tahun != '') {
            $query->whereYear('tgl_input', $request->tahun);
        }

        $pendapatan = $query->orderBy(DB::raw('YEAR(tgl_input)'), 'desc')
            ->orderBy('tgl_input', 'desc')
            ->get();

        $years = DB::table('pendapatans')
            ->selectRaw('YEAR(tgl_input) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->get();
        return view('admin.pendapatan.index', compact('page', 'pendapatan', 'years'));
    }

    public function store(Request $request)
    {
        $this->validasiPendapatan($request, 'required');
        $image = $this->getImage($request->file('img'), $request->sumber_dana);
        $data = [
            'tgl_input' => request('tgl_input'),
            'sumber_dana' => request('sumber_dana'),
            'jumlah_anggaran' => request('jumlah_anggaran'),
            'img' => $image
        ];
        $Pendapatan = Pendapatan::create($data);
        if ($Pendapatan) {
            return redirect()->back()->with('success', 'Berhasil Menambahkan Data Pendapatan');
        } else {
            return redirect()->back()->with('error', 'Gagal Menambahkan Data Pendapatan');
        }
    }

    public function update(Request $request, $id)
    {
        $pendapatan = Pendapatan::findOrFail($id);

        $this->validasiPendapatan($request, 'sometimes');

        if ($request->hasFile('img')) {
            $this->deleteImage('pendapatan', $pendapatan->img);
            $image = $this->getImage($request->file('img'), $request->sumber_dana);
        } else {
            $image = $pendapatan->img;
        }

        $pendapatan->update([
            'tgl_input' => $request->tgl_input,
            'sumber_dana' => $request->sumber_dana,
            'jumlah_anggaran' => $request->jumlah_anggaran,
            'img' => $image
        ]);

        return redirect()->back()->with('success', 'Berhasil Merubah Data Pendapatan');
    }

    public function destroy($id)
    {
        $pendapatan = Pendapatan::findOrFail($id);

        if ($pendapatan->img) {
            $this->deleteImage('pendapatan', $pendapatan->img);
        }
        $pendapatan->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data Pendapatan');
    }

    public function exportExcel(Request $request)
    {
        $tahun = $request->input('tahun');

        // Filter berdasarkan tahun created_at atau updated_at
        $pendapatan = Pendapatan::when($tahun, function ($query, $tahun) {
            $query->whereYear('tgl_input', $tahun);
        })->get();

        return Excel::download(new PendapatanExport($pendapatan), 'pendapatan_' . ($tahun ?? 'semua') . '.xlsx');
    }
}
