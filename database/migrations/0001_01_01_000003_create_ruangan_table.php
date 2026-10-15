<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ruangan', function (Blueprint $table) {
            $table->increments('id_ruangan');
            $table->string('nama_ruangan', 255);
            $table->string('gedung', 255);
            $table->integer('kapasitas');
            $table->text('fasilitas')->nullable();
            $table->enum('status', ['tersedia', 'tidak tersedia'])->default('tersedia');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ruangan');
    }
};
