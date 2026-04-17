<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Drop foreign relationship from pembayaran first
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropForeign(['kamar_id']);
        });

        // 2. Refactor kamar table
        Schema::table('kamar', function (Blueprint $table) {
            // Remove auto-increment and primary key from nomor
            // We use change() to remove the auto-increment property first
            $table->integer('nomor')->change();
            $table->dropPrimary();
        });

        Schema::table('kamar', function (Blueprint $table) {
            // Add new auto-incrementing ID as Primary Key
            $table->id('id')->first();

            // Make kos_id non-nullable for data integrity
            $table->foreignId('kos_id')->nullable(false)->change();

            // Add the composite unique constraint
            $table->unique(['nomor', 'kos_id']);
        });

        // 3. Update pembayaran to point to new kamar.id instead of nomor
        // We match them where pembayaran.kamar_id (the old room number) equals kamar.nomor
        DB::statement('UPDATE pembayaran p JOIN kamar k ON p.kamar_id = k.nomor SET p.kamar_id = k.id');

        // 4. Restore foreign key in pembayaran
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->foreignId('kamar_id')->change()->constrained('kamar')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropForeign(['kamar_id']);
        });

        Schema::table('kamar', function (Blueprint $table) {
            $table->dropUnique(['nomor', 'kos_id']);
            $table->dropPrimary();
            $table->dropColumn('id');
        });

        Schema::table('kamar', function (Blueprint $table) {
            $table->bigIncrements('nomor')->primary()->change();
        });

        // We can't easily revert the data mapping in pembayaran unless we know the previous state
        // But we'll try to map it back if columns still match
        DB::statement('UPDATE pembayaran p JOIN kamar k ON p.kamar_id = k.nomor SET p.kamar_id = k.nomor');

        Schema::table('pembayaran', function (Blueprint $table) {
            $table->foreignId('kamar_id')->change()->constrained('kamar', 'nomor')->cascadeOnDelete();
        });
    }
};
