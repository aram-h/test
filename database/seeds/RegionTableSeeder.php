<?php

use Illuminate\Database\Seeder;
use App\Region;
use \App\Country;

class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Region::query()->delete();

        foreach ($this->getRegions() as $k => $region) {
            $model = new Region();
            $model->id = ($k + 1);
            foreach ($region as $attr => $value) {
                $model->{$attr} = $value;
            }

            $model->save();
        }
    }

    public function getRegions()
    {
        $data = [];
        $regions = [
            'Region 1 in Thailand',
            'Region 2 in Thailand',
            'Region 4 in Cambodia',
            'Region 3 in Cambodia'
        ];

        $countries = \App\Country::all()->pluck('name', 'id');


        foreach ($regions as $pos => $region) {
            foreach ($countries as $key => $country) {
                if (strpos($region, $country) !== false) {
                    $data[] = [
                        'country_id' => $key,
                        'name' => $region
                    ];
                }
            }
        }

        return $data;
    }
}
