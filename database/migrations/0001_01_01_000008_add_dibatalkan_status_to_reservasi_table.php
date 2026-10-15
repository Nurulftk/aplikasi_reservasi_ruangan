<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add 'dibatalkan' to the status enum
        DB::statement("ALTER TABLE `reservasi` MODIFY `status` ENUM('menunggu','diterima','ditolak','dibatalkan') NOT NULL DEFAULT 'menunggu'");
    }

    public function down(): void
    {
        // Revert to previous enum without 'dibatalkan'
        DB::statement("ALTER TABLE `reservasi` MODIFY `status` ENUM('menunggu','diterima','ditolak') NOT NULL DEFAULT 'menunggu'");
    }
};
