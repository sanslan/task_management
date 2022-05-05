<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Task::truncate();
        Project::truncate();
         \App\Models\User::factory(1)->create();
        $this->call([
            ProjectSeeder::class,
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
