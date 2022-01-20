<?php

use Illuminate\Database\Seeder;

class ComprovanteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Comprovante::class, 100)->create();
        //
    }
}
