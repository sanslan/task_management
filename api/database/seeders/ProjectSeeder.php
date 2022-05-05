<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use Database\Factories\ProjectFactory;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::factory()
            ->has(Task::factory()->count(3))
            ->count(5)
            ->create();
    }
}
