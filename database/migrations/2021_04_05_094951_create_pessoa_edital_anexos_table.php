<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoaEditalAnexosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoa_edital_anexos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('edital_dinamico_id');
            $table->unsignedBigInteger('tipo_anexo_id');
            $table->unsignedBigInteger('pessoa_id');
            $table->unsignedBigInteger('documento_dinamico_id');
            $table->unsignedBigInteger('pontuacao_edital_id')->nullable();
            $table->string('pontuacao')->nullable();
            $table->string('pontuacao_exp_publico')->nullable();
            $table->string('pontuacao_exp_privado')->nullable();
            $table->string('nome_arquivo', 250);

            $table->foreign('documento_dinamico_id')->references('id')->on('documento_dinamicos');
            $table->foreign('edital_dinamico_id')->references('id')->on('edital_dinamicos');
            $table->foreign('tipo_anexo_id')->references('id')->on('tipo_anexo');
            $table->foreign('pessoa_id')->references('id')->on('pessoa');
            $table->foreign('pontuacao_edital_id')->references('id')->on('pontuacao_edital');

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
        Schema::dropIfExists('pessoa_edital_anexos');
    }
}
