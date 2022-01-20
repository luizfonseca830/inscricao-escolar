<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pessoas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('pessoa', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cargo_id')->unsigned();
            $table->unsignedBigInteger('escolaridade_id');
            $table->unsignedBigInteger('endereco_id');
            $table->unsignedBigInteger('comprovante_id')->nullable();
            $table->unsignedBigInteger('edital_dinamico_id');
            $table->unique(['cpf', 'edital_dinamico_id']);

            $table->string('nome_completo');
            $table->string('cpf');
            $table->string('rg', 15);
            $table->string('orgao_emissor');
            $table->string('pis', '15')->nullable();
            $table->string('telefone');
            $table->string('nacionalidade', 100);
            $table->string('naturalidade');
            $table->date('data_nascimento');
            $table->string('sexo');
            $table->string('email');
            $table->boolean('portador_deficiencia');
            $table->boolean('status')->nullable();
            $table->boolean('status_avaliado')->nullable();
            $table->boolean('status_revisado')->nullable();
            $table->boolean('status_pericia_pne')->nullable();
            $table->string('motivo_rev', 500)->nullable();
            $table->boolean('check_cadastro_anexo')->nullable();

            $table->foreign('cargo_id')->references('id')->on('cargos');
            $table->foreign('escolaridade_id')->references('id')->on('escolaridade');
            $table->foreign('endereco_id')->references('id')->on('endereco');
            $table->foreign('comprovante_id')->references('id')->on('comprovante');
            $table->foreign('edital_dinamico_id')->references('id')->on('edital_dinamicos');
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
        //
        Schema::dropIfExists('pessoa');
    }
}
