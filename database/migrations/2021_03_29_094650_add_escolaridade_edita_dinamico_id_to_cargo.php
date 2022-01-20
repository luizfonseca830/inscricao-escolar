<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEscolaridadeEditaDinamicoIdToCargo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cargos', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('escolaridade_edital_dinamico_id')->nullable();
            $table->foreign('escolaridade_edital_dinamico_id')->references('id')->on('escolaridade_edital_dinamicos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cargos', function (Blueprint $table) {
            //
        });
    }
}
