<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class category extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Jalan dan Jembatan',
            ],
            [
                'name' => 'Penerangan Jalan',
            ],
            [
                'name' => 'Sanitasi',
            ],
            [
                'name' => 'Keamanan dan Ketertiban',
            ],
            [
                'name' => 'Lingkungan',
            ],
            [
                'name' => 'Kesehatan',
            ],
            [
                'name' => 'Pendidikan',
            ],
            [
                'name' => 'Sosial',
            ],
        ]);
    }
}
