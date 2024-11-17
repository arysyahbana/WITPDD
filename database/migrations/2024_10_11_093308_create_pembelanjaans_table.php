<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembelanjaans', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_transaksi');
            $table->text('uraian');
            $table->foreignId('anggaran_id')->references('id')->on('anggarans')->onDelete('cascade');
            $table->foreignId('pendapatan_id')->references('id')->on('pendapatans')->onDelete('cascade');
            $table->integer('jumlah_anggaran');
            $table->string('img_transaksi');
            $table->string('img_kegiatan')->nullable();
            $table->string('img_terealisasi')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelanjaans');
    }
};
