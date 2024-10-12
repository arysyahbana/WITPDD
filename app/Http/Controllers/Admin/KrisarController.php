<?php

namespace App\Http\Controllers\Admin;

use App\Exports\KrisarExport;
use App\Http\Controllers\Controller;
use App\Models\Krisar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class KrisarController extends Controller
{
    public function index(Request $request)
    {
        $page = 'Krisar';

        $query = Krisar::query();

        // Cek apakah ada filter tahun
        if ($request->has('tahun') && $request->tahun != '') {
            $query->whereYear('created_at', $request->tahun);
        }
        $krisar = $query->latest()->get();
        $years = DB::table('krisars')
            ->selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->get();
        return view('admin.krisar.index', compact('page', 'krisar', 'years'));
    }

    public function exportExcel(Request $request)
    {
        $tahun = $request->input('tahun');

        // Filter berdasarkan tahun created_at atau updated_at
        $krisar = Krisar::when($tahun, function ($query, $tahun) {
            $query->whereYear('updated_at', $tahun)
                ->orWhereYear('created_at', $tahun);
        })->get();

        return Excel::download(new KrisarExport($krisar), 'krisar_' . ($tahun ?? 'semua') . '.xlsx');
    }
}
