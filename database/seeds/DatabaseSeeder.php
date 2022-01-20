<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        #Schema::disableForeignKeyConstraints();
        $this->call([UsersTableSeeder::class]);
        $this->call([EscolaridadesTableSeeder::class]);
        $this->call(TipoTelasTableSeeder::class);
        $this->call([TelasEditalSeeder::class]);
        $this->call(EscolaridadeEditalDinamicosTableSeeder::class);
//        $this->call([CargoTableSeeder::class]);
        $this->call(TituloTableSeeder::class);
        $this->call(CarrosselTableSeeder::class);
        $this->call(TipoAnexoTableSeeder::class);
        #$this->call(ComprovanteTableSeeder::class);
        #$this->call(EnderecoTableSeeder::class);
        #$this->call(AnexoTableSeeder::class);
        #$this->call(PessoaTableSeeder::class);
        #Schema::enableForeignKeyConstraints();
    }
}
