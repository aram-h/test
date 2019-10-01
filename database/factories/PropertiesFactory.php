<?php

use Faker\Generator as Faker;
use \App\Property;

const PROPERTY_COUNT = 2001;
const TEMPLATE_1 = 3000;
$data['property_type_ids_count'] = count(\App\PropertyType::$types);
$data['project_names_count'] = \App\ProjectName::all()->count();
$data['projectNamesIds'] = range(1, $data['project_names_count']);
$data['statuses_count'] = count(\App\Status::$statuses);
$data['regions_count'] = \App\Region::all()->count();
$data['randomNum'] = rand(1, $data['project_names_count']);
unset($data['projectNamesIds'][$data['randomNum'] - 1]);
$data['regions'] = \App\Region::with('country')->get()->toArray();
$data['propertiesCount'] = setDefaultCounter($data['projectNamesIds']);


$factory->define(Property::class, function (Faker $faker) use ($data) {


    static $pk = 1;
    static $onePropertyMust = PROPERTY_COUNT;
    static $templateCounter = TEMPLATE_1;
    $propertiesCount = $data['propertiesCount'];


    $fakerRandom = $faker->randomElements($data['projectNamesIds'], 1)[0];


    $property_type_id = $faker->numberBetween(1, $data['property_type_ids_count']);
    $bathroom = $faker->numberBetween(1, 10);
    $bedroom = $faker->numberBetween(1, 20);
    $status_id = $faker->numberBetween(1, $data['statuses_count']);
    $for_sale_id = $faker->numberBetween(1, 2);
    $project_names_id = $fakerRandom;
    $region_id = $faker->numberBetween(1, $data['regions_count']);
    $for_rent_id = $faker->numberBetween(1, 2);


    if ($status_id == 2 && $property_type_id == 2 && $region_id == 3 && $for_rent_id == 1) {
        $property_type_id = 3;
    }


    if ($templateCounter < 0) {
        if ($onePropertyMust > 0) {
            $project_names_id = $data['randomNum'];
        } else {

            if ($propertiesCount[$fakerRandom] != PROPERTY_COUNT - 1) {
                $fakerRandom = checkPropertyLimit($propertiesCount);
            }

            $propertiesCount[$fakerRandom] += 1;

            $project_names_id = $fakerRandom;

        }

        $onePropertyMust--;
    } else {
        $status_id = 1;
        $bedroom = 2;
        $property_type_id = 1;
        $for_sale_id = 1;
        if ($project_names_id == $data['randomNum']) $onePropertyMust--;
    }

    $templateCounter--;


    return [
        'id' => $pk++,
        'title' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'description' => $faker->paragraph,
        'bedroom' => $bedroom,
        'bathroom' => $bathroom,
        'property_type_id' => $property_type_id,
        // 'project_name_id' => $faker->numberBetween(1, $project_names_count),
        'project_name_id' => $project_names_id,
        'status_id' => $status_id,
        'for_sale_id' => $for_sale_id,
        'for_rent_id' => $for_rent_id,
        'region_id' => $region_id,
    ];
});


function checkPropertyLimit($propertiesCount)
{
    $randomIndex = array_rand($propertiesCount);
    return ($propertiesCount[$randomIndex] == 2000) ? checkPropertyLimit($propertiesCount) : $propertiesCount[$randomIndex] + 1;
}

function setDefaultCounter($array)
{
    $result = [];
    if ($array) {
        foreach ($array as $id) {
            $result[$id] = 0;
        }
    }

    return $result;
}


