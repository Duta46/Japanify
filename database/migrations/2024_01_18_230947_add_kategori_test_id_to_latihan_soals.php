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
        Schema::table('latihan_soals', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_test_id')->nullable();
            $table->foreign('kategori_test_id')->references('id')->on('kategori_tests');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('latihan_soals', function (Blueprint $table) {
            //
        });
    }
};
