<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Anexos::class, function (Faker $faker) {
    return [
        //
        'documento_pessoas' => $faker->name,
        'anexo_escolaridade' => $faker->name,
    ];
});
