<?php

use Illuminate\Database\Seeder;

class TipoTelasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tipo_telas')->insert([
            'tipo' => 'Tela',
        ]);

        DB::table('tipo_telas')->insert([
            'tipo' => 'PDF',
        ]);

        DB::table('tipo_telas')->insert([
            'tipo' => 'Formulario',
        ]);
    }
}
