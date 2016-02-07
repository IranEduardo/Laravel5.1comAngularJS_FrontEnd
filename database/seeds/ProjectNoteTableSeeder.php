<?php

use Illuminate\Database\Seeder;
use CodeProject\Entities\Project;
use CodeProject\Entities\ProjectNote;

class ProjectNoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Project::truncate();
        factory(ProjectNote::class,50)->create();
    }
}
