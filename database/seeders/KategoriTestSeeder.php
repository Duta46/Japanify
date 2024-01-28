<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori_tests')->insert([
            [
                'name' => 'N5'
            ],
            [
                'name' => 'N4'
            ],
            [
                'name' => 'N3'
            ],
            [
                'name' => 'N2'
            ],
            [
                'name' => 'N1'
            ],
        ]);
    }
}
