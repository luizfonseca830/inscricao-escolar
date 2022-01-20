<?php

use Illuminate\Database\Seeder;

class EscolaridadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('escolaridade')->insert([
            'nivel_escolaridade' => 'Nível Fundamental'
        ]);

        DB::table('escolaridade')->insert([
            'nivel_escolaridade' => 'Nível Médio'
        ]);

        DB::table('escolaridade')->insert([
            'nivel_escolaridade' => 'Nível Superior'
        ]);

        DB::table('escolaridade')->insert([
            'nivel_escolaridade' => 'Nível Fundamental Incompleto'
        ]);

        DB::table('escolaridade')->insert([
            'nivel_escolaridade' => 'Nível Médio Incompleto'
        ]);

        DB::table('escolaridade')->insert([
            'nivel_escolaridade' => 'Nível Superior Incompleto'
        ]);
    }
}
