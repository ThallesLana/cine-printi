<?php

namespace Database\Seeders;

use App\Models\Movies as ModelsMovies;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Movies extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsMovies::create([
            'title' => 'The Batman',
            'category' => 'action',
            'age_range' => 16,
            'release_year' => '2022'
        ]);
    }
}
