<?php

use Illuminate\Database\Seeder;

class TipoAnexoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tipo_anexo')->insert([
            'tipo' => 'Documentos Pessoais',
        ]);

        DB::table('tipo_anexo')->insert([
            'tipo' => 'Curso Técnico',
        ]);

        DB::table('tipo_anexo')->insert([
            'tipo' => 'Especialização',
        ]);

        DB::table('tipo_anexo')->insert([
            'tipo' => 'Mestrado',
        ]);

        DB::table('tipo_anexo')->insert([
            'tipo' => 'Douturado',
        ]);

        DB::table('tipo_anexo')->insert([
            'tipo' => 'Experiência',
        ]);
    }
}
