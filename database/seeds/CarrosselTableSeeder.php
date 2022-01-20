<?php

use Illuminate\Database\Seeder;

class CarrosselTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('carrossel')->insert([
            'url_img' => 'logo_pref.png',
            'url_link' => 'http://127.0.0.1:8000/registro',
        ]);
    }
}
