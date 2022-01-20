<?php

use Illuminate\Database\Seeder;

class AnexoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\Models\Anexos::class, 100)->create();
    }
}
