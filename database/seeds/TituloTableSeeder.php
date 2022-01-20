<?php

use Illuminate\Database\Seeder;

class TituloTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('titulo')->insert([
            'titulo' => 'Exemplo'
        ]);
    }
}
