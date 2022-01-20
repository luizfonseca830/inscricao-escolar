<?php

use Illuminate\Database\Seeder;

class TelasEditalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('telas_edital')->insert([
            'tipo_tela_id' => '1',
            'nome_ou_anexo' => 'Recurso',
            'status_liberar' => 0,
            'data_liberar' => null,
        ]);

        DB::table('telas_edital')->insert([
            'tipo_tela_id' => '1',
            'nome_ou_anexo' => 'Protocolo',
            'status_liberar' => 0,
            'data_liberar' => null,
        ]);
    }
}
