<?php

use Illuminate\Database\Seeder;
use \App\ProjectName;
class ProjectNameTableSeeder extends Seeder
{
    const COUNTER = 10000;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectName::query()->delete();
        factory(ProjectName::class, self::COUNTER)->create();
    }
}
