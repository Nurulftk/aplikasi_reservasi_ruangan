<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->increments('id_laporan');
            $table->unsignedInteger('id_reservasi');
            $table->date('tanggal_cetak');
            $table->text('keterangan')->nullable();

            $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasi')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
