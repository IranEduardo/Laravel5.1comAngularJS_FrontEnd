<?php

use Illuminate\Database\Seeder;
use CodeProject\Entities\ProjectMember;

class ProjectMemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Project::truncate();
        factory(ProjectMember::class,20)->create();
    }
}
