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
        Schema::table('kategori_tests', function (Blueprint $table) {
            $table->string('point_kategori_1')->nullable();
            $table->string('point_kategori_2')->nullable();
            $table->string('point_kategori_3')->nullable();
            $table->string('point_kategori_4')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kategori_tests', function (Blueprint $table) {
            $table->dropColumn('point_kategori_1');
            $table->dropColumn('point_kategori_2');
            $table->dropColumn('point_kategori_3');
            $table->dropColumn('point_kategori_4');
        });
    }
};
