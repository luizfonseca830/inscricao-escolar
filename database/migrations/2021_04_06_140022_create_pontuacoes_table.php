<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePontuacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pontuacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pessoa_id');
            $table->unsignedBigInteger('avaliador_id')->nullable();
            $table->unsignedBigInteger('revisor_id')->nullable();

            $table->string('pontuacao_total');
            $table->string('pontuacao_total_publica', 100)->nullable();
            $table->string('pontuacao_total_privada', 100)->nullable();
            $table->string('pontuacao_total_anexos', 100)->nullable();


            $table->foreign('pessoa_id')->references('id')->on('pessoa');
            $table->foreign('avaliador_id')->references('id')->on('users');
            $table->foreign('revisor_id')->references('id')->on('users');
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
        Schema::dropIfExists('pontuacoes');
    }
}
