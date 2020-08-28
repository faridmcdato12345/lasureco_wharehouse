<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Material;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Material::class, function (Faker $faker) {
    return [
        'code_number'=>$faker->creditCardNumber,
        'name'=>$faker->name,
        'quantity'=>$faker->randomNumber($nbDigits = NULL, $strict = false),
        'unit'=>$faker->word,
    ];
});
