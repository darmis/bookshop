<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Genre;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [

            [
                'genre' => 'Classic'
            ],
            [
                'genre' => 'Detective'
            ],
            [
                'genre' => 'Horror'
            ],
            [
                'genre' => 'Novel'
            ],
            [
                'genre' => 'Sci-Fi'
            ],
            [
                'genre' => 'Romance'
            ],
        ];

        Genre::insert($genres);
    }
}
