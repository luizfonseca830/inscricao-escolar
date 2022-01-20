<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransparenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transparencia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instrutor_id');
            $table->unsignedBigInteger('pessoa_id');
            $table->string('tela', 100);
            $table->string('pontuacao_total')->nullable();
            $table->string('pontuacao_total_anexos')->nullable();
            $table->string('pontuacao_total_publica')->nullable();
            $table->string('pontuacao_total_privada')->nullable();
            $table->string('motivo', 500)->nullable();
            $table->timestamps();
            $table->foreign('instrutor_id')->references('id')->on('users');
            $table->foreign('pessoa_id')->references('id')->on('pessoa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transparencia');
    }
}
