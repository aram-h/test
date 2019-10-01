<?php

use Illuminate\Database\Seeder;
use App\Property;
class PropertyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Property::query()->delete();
        factory(Property::class, 30000)->create();
    }
}
