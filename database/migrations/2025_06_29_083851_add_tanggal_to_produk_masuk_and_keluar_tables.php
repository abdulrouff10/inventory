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
        Schema::table('produk_masuk', function (Blueprint $table) {
            $table->date('tanggal')->after('jumlah');
        });

        Schema::table('produk_keluar', function (Blueprint $table) {
            $table->date('tanggal')->after('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk_masuk', function (Blueprint $table) {
            $table->dropColumn('tanggal');
        });

        Schema::table('produk_keluar', function (Blueprint $table) {
            $table->dropColumn('tanggal');
        });
    }
};
