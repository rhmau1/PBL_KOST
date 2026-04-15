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
        Schema::table('penghuni', function (Blueprint $table) {
            $table->string('no_hp')->nullable()->change();
            $table->string('nama_wali')->nullable()->change();
            $table->string('no_hp_wali')->nullable()->change();
            $table->string('alamat')->nullable()->change();
            $table->date('tanggal_masuk')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('penghuni', function (Blueprint $table) {
            $table->string('no_hp')->nullable(false)->change();
            $table->string('nama_wali')->nullable(false)->change();
            $table->string('no_hp_wali')->nullable(false)->change();
            $table->string('alamat')->nullable(false)->change();
            $table->date('tanggal_masuk')->nullable(false)->change();
        });
    }
};
