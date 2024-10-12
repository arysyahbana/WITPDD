<?php

use App\Http\Controllers\Admin\AnggaranController;
use App\Http\Controllers\Admin\BidangController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KrisarController;
use App\Http\Controllers\Admin\LaporanKeuanganController;
use App\Http\Controllers\Admin\OperatorController;
use App\Http\Controllers\Admin\PemasukanController;
use App\Http\Controllers\Admin\PembelanjaanController;
use App\Http\Controllers\Admin\PendapatanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

route::get('/', [HomeController::class, 'index'])->name('home');
route::post('/krisar-store', [HomeController::class, 'store'])->name('krisar.store');

route::middleware('auth')->group(function () {
    route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('pendapatan')->group(function () {
        route::get('/show', [PendapatanController::class, 'index'])->name('pendapatan.index');
        route::post('/store', [PendapatanController::class, 'store'])->name('pendapatan.store');
        route::post('/update/{id}', [PendapatanController::class, 'update'])->name('pendapatan.update');
        route::get('/destroy/{id}', [PendapatanController::class, 'destroy'])->name('pendapatan.destroy');
        route::get('/export-excel', [PendapatanController::class, 'exportExcel'])->name('pendapatan.export');
    });

    // Route::prefix('bidang')->group(function () {
    //     route::get('/show', [BidangController::class, 'index'])->name('bidang.index');
    //     route::post('/store', [BidangController::class, 'store'])->name('bidang.store');
    //     route::post('/update/{id}', [BidangController::class, 'update'])->name('bidang.update');
    //     route::get('/destroy/{id}', [BidangController::class, 'destroy'])->name('bidang.destroy');
    // });

    Route::prefix('anggaran')->group(function () {
        route::get('/show', [AnggaranController::class, 'index'])->name('anggaran.index');
        route::post('/store', [AnggaranController::class, 'store'])->name('anggaran.store');
        route::post('/update/{id}', [AnggaranController::class, 'update'])->name('anggaran.update');
        route::get('/destroy/{id}', [AnggaranController::class, 'destroy'])->name('anggaran.destroy');
        route::get('/export-excel', [AnggaranController::class, 'exportExcel'])->name('anggaran.export');
    });

    Route::prefix('pembelanjaan')->group(function () {
        route::get('/show', [PembelanjaanController::class, 'index'])->name('pembelanjaan.index');
        route::post('/store', [PembelanjaanController::class, 'store'])->name('pembelanjaan.store');
        route::post('/update/{id}', [PembelanjaanController::class, 'update'])->name('pembelanjaan.update');
        route::get('/destroy/{id}', [PembelanjaanController::class, 'destroy'])->name('pembelanjaan.destroy');
        route::get('/export-excel', [PembelanjaanController::class, 'exportExcel'])->name('pembelanjaan.export');
    });
    Route::prefix('laporan')->group(function () {
        route::get('/show', [LaporanKeuanganController::class, 'index'])->name('laporan.index');
        Route::get('/export-excel', [LaporanKeuanganController::class, 'exportExcel'])->name('laporan.export');
    });
    Route::prefix('krisar')->group(function () {
        route::get('/show', [KrisarController::class, 'index'])->name('krisar.index');
        route::get('/export-excel', [KrisarController::class, 'exportExcel'])->name('krisar.export');
    });
    Route::prefix('opearator')->group(function () {
        route::get('/show', [OperatorController::class, 'index'])->name('operator.index');
        route::post('/store', [OperatorController::class, 'store'])->name('operator.store');
        route::post('/update/{id}', [OperatorController::class, 'update'])->name('operator.update');
        route::get('/destroy/{id}', [OperatorController::class, 'destroy'])->name('operator.destroy');
    });
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
