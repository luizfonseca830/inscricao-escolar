<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoDinamicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_dinamicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('edital_dinamico_tipo_anexo_id');
            $table->unsignedBigInteger('pontuacao_edital_id')->nullable();
            $table->string('nome_documento');
            $table->boolean('obrigatorio')->default(false);
            $table->double('pontuacao_maxima_documento')->nullable();
            $table->double('pontuacao_maxima_item')->nullable();
            $table->double('pontuacao_por_item')->nullable();
            $table->integer('quantidade_anexos')->nullable();
            $table->double('pontuacao_por_ano')->nullable();
            $table->double('pontuacao_por_mes')->nullable();
            $table->boolean('tipo_experiencia')->nullable();
            $table->boolean( 'pontuar_publica_privada')->nullable();
            $table->boolean( 'pontuar_manual')->default(0)->nullable();
            $table->boolean('especial')->nullable();

            $table->foreign('edital_dinamico_tipo_anexo_id')->references('id')->on('edital_dinamico_tipo_anexos');
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
        Schema::dropIfExists('documento_dinamicos');
    }
}
