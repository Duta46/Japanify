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
            $table->unsignedBigInteger('paket_soal_latihan_soal_id');
            $table->foreign('paket_soal_latihan_soal_id')->references('id')->on('paket_soal_latihan_soals');
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
