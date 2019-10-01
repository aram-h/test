<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;


$factory->define(App\ProjectName::class, function (Faker $faker) {
    static $pk = 1;
    return [
        'id' => $pk++,
        'name' => 'project_' . $faker->randomNumber() . '_' . $faker->sentences(1, true),
    ];
});
