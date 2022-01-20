<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Comprovante::class, function (Faker $faker) {
    return [
        //
        'comprovante' => $faker->randomNumber(),
    ];
});
