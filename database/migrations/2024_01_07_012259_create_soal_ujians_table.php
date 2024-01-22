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
        Schema::create('soal_ujians', function (Blueprint $table) {
            $table->id();
            $table->text('question')->nullable();
            $table->string('question_image')->nullable();
            $table->string('question_audio')->nullable();
            $table->text('answer_a')->nullable();
            $table->string('answer_a_image')->nullable();
            $table->text('answer_b')->nullable();
            $table->string('answer_b_image')->nullable();
            $table->text('answer_c')->nullable();
            $table->string('answer_c_image')->nullable();
            $table->text('answer_d')->nullable();
            $table->string('answer_d_image')->nullable();
            $table->string('correct_answer');
            $table->string('point_soal');
            $table->foreignId('paket_soal_id')->constrained('paket_soals');
            $table->foreignId('kategori_id')->constrained('kategoris');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_ujians');
    }
};
