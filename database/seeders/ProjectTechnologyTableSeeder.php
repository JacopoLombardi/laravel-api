<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Technology;

class ProjectTechnologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 50; $i ++){
            // estraggo un project random
            $project = Project::inRandomOrder()->first();

            // estraggo un id random di technology
            $technology_id = Technology::inRandomOrder()->first()->id;

            // aggiungo la relazione nella tabella ponte
            $project->technologies()->attach($technology_id);
        }

    }
}
