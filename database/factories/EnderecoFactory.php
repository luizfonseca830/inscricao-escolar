<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Endereco::class, function (Faker $faker) {
    return [
        //
        'endereco' => $faker->state,
        'bairro' => $faker->streetSuffix,
        'cep' => $faker->streetAddress,
    ];
});
