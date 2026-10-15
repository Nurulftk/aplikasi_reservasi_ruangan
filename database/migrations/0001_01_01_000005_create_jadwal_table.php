<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->increments('id_jadwal');
            $table->unsignedInteger('id_ruangan');
            $table->unsignedInteger('id_reservasi');
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->text('keterangan')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('id_ruangan')->references('id_ruangan')->on('ruangan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasi')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
