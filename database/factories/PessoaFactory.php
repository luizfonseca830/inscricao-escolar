<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Pessoa::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\pt_BR\Person($faker));
    $faker->addProvider(new \Faker\Provider\pt_BR\PhoneNumber($faker));
    return [
        //
        'cargo_id' => \App\Models\Cargo::all()->random()->id,
        'escolaridade_id'=> \App\Models\Escolaridade::all()->random()->id,
        'comprovante_id' => \App\Models\Comprovante::all()->random()->id,
        'endereco_id' => \App\Models\Endereco::all()->random()->id,
        'anexo_id' => $faker->randomElement([null, \App\Models\Anexos::all()->random()->id]),
        'nome_completo' => $faker->name,
        'cpf' => $faker->cpf,
        'rg' => $faker->rg,
        'orgao_emissor' => $faker->text,
        'pis' => $faker->randomDigit(10, 0, 9999),
        'telefone' => $faker->cellphoneNumber,
        'nacionalidade' => $faker->streetSuffix,
        'naturalidade' => $faker->streetSuffix,
        'data_nascimento' => $faker->date('Y-m-d'),
        'sexo' => $faker->randomElement(['M', 'H']),
        'email' => $faker->email,
        'portador_deficiencia' => $faker->numberBetween(0, 1),
    ];
});
