<?php

use Illuminate\Database\Seeder;
use App\ForRent;
class ForRentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ForRent::query()->delete();

        foreach (ForRent::$types as $k => $type) {
            $model = new ForRent();
            $model->id = $k+1;
            $model->name = $type;
            $model->save();
        }
    }
}
