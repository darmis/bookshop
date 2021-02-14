<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            'genre' => 'Detective',
        ]);
        DB::table('genres')->insert([
            'genre' => 'Romance',
        ]);
        DB::table('genres')->insert([
            'genre' => 'Sci-Fi',
        ]);
        DB::table('genres')->insert([
            'genre' => 'Novel',
        ]);
    }
}
