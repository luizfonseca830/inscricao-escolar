<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePontuacaoEditalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pontuacao_edital', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('edital_dinamico_id');
            $table->unsignedBigInteger('tipo_anexo_id');
            $table->double('pontuacao_maxima_edital')->nullable();

            $table->foreign('edital_dinamico_id')->references('id')->on('edital_dinamicos');
            $table->foreign('tipo_anexo_id')->references('id')->on('tipo_anexo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pontuacao_edital');
    }
}
