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
        Schema::create('paket_soal_latihan_soals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('jumlah_soal')->default(0);
            $table->foreignId('kategori_test_id')->constrained('kategori_tests');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_soal_latihan_soals');
    }
};
