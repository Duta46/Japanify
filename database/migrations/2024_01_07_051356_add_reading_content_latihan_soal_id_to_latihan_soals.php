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
            $table->unsignedBigInteger('reading_latihan_soal_id')->nullable();
            $table->foreign('reading_latihan_soal_id')->references('id')->on('reading_content_latihan_soals');
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
