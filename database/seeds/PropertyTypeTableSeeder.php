<?php

use Illuminate\Database\Seeder;
use \App\PropertyType;
class PropertyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        PropertyType::query()->delete();

        foreach (PropertyType::$types as $k => $type) {
            $model = new PropertyType();
            $model->id = $k + 1;
            $model->name = $type;
            $model->save();
        }
    }
}
