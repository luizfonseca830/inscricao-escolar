<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelasEditalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telas_edital', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_tela_id');
            $table->string('nome_anexo_mostrar', 250)->unique()->nullable();
            $table->string('nome_ou_anexo', 250)->unique();
            $table->double('pontuacao_total')->nullable();
            $table->boolean('status_liberar')->default(0);
            $table->dateTime('data_liberar')->nullable();
            $table->dateTime('data_fecha')->nullable();
            $table->timestamps();

            $table->foreign('tipo_tela_id')->references('id')->on('tipo_telas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telas_edital');
    }
}
