<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Untuk MySQL/MariaDB
        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'confirmed', 'rejected') NOT NULL DEFAULT 'pending'");
        } 
        // Untuk PostgreSQL
        else if (DB::connection()->getDriverName() === 'pgsql') {
            // Buat type enum baru
            DB::statement("ALTER TYPE order_status_enum ADD VALUE 'rejected' AFTER 'confirmed'");
        }
        // Untuk SQLite atau database lainnya
        else {
            // SQLite tidak mendukung ENUM, jadi kita hanya memastikan data valid di level aplikasi
            // Tidak ada perubahan schema yang diperlukan
        }
    }

    /**
     * Reverse the migrations.
     * 
     * Catatan: Pada sebagian besar database, menghapus nilai enum sulit atau tidak mungkin
     * tanpa membuat ulang tabel. Jadi kita hanya membiarkannya tetap ada.
     */
    public function down(): void
    {
        // Tidak ada downgrade yang perlu dilakukan
    }
};