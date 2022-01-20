<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscolaridadeEditalDinamicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escolaridade_edital_dinamicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('edital_dinamico_id');
            $table->unsignedBigInteger('escolaridade_id');

            $table->foreign('edital_dinamico_id')->references('id')->on('edital_dinamicos');
            $table->foreign('escolaridade_id')->references('id')->on('escolaridade');
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
        Schema::dropIfExists('escolaridade_edital_dinamicos');
    }
}
