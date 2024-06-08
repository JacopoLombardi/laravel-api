<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;
use App\Models\Type;
use App\Functions\Helper;


class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for($i = 0; $i < 20; $i ++){
            $new_project = new Project();
            // associo randomicamente un Type ad un Post
            $new_project->type_id = Type::inRandomOrder()->first()->id;
            $new_project->title = $faker->sentence(3);
            $new_project->slug = Helper::createSlug($new_project->title, Project::class);
            $new_project->link = $faker->sentence();
            $new_project->description = $faker->text();

            $new_project->save();
        }
    }
}
