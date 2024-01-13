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
        Schema::table('soal_ujians', function (Blueprint $table) {
            $table->unsignedBigInteger('reading_ujian_id')->nullable();
            $table->foreign('reading_ujian_id')->references('id')->on('reading_content_ujians');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('soal_ujians', function (Blueprint $table) {
            //
        });
    }
};
