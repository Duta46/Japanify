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
                'name' => 'N5',
                'point_ujian' => '80',

            ],
            [
                'name' => 'N4',
                'point_ujian' => '90',
            ],
            [
                'name' => 'N3',
                'point_ujian' => '95',
            ],
            [
                'name' => 'N2',
                'point_ujian' => '90',
            ],
            [
                'name' => 'N1',
                'point_ujian' => '100',
            ],
        ]);
    }
}
