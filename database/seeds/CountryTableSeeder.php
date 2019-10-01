<?php

use Illuminate\Database\Seeder;
use App\Country;
class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = ['Thailand', 'Cambodia'];

        Country::query()->delete();
        foreach ($countries as $country) {
            $model = new Country();
            $model->name = $country;
            $model->save();
        }

    }
}
