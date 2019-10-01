<?php

use Illuminate\Database\Seeder;
use \App\ForSale;
class ForSaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ForSale::query()->delete();

        foreach (ForSale::$types as $k => $type) {
            $model = new ForSale();
            $model->id = $k+1;
            $model->name = $type;
            $model->save();
        }
    }
}
