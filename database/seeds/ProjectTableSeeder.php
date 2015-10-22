<?php

use Illuminate\Database\Seeder;
use CodeProject\Entities\Project;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Project::truncate();
        factory(Project::class,10)->create();
    }
}
