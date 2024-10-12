<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Krisar;
use App\Models\Pembelanjaan;
use App\Models\Pendapatan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $page = 'Dashboard';

        $currentYear = Carbon::now()->year;

        $total_pendapatan = Pendapatan::whereYear('tgl_input', $currentYear)->sum('jumlah_anggaran');

        $total_pembelanjaan = Pembelanjaan::whereYear('tgl_transaksi', $currentYear)->sum('jumlah_anggaran');

        $krisar = Krisar::count();

        $operator = User::count();

        return view('admin.dashboard', compact('page', 'total_pendapatan', 'total_pembelanjaan', 'krisar', 'operator'));
    }
}
