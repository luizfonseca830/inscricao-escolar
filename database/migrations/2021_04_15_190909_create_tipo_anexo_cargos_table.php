<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoAnexoCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_anexo_cargos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_anexo_id');
            $table->unsignedBigInteger('cargo_id');

            $table->foreign('tipo_anexo_id')->references('id')->on('tipo_anexo');
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete("cascade");
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
        Schema::dropIfExists('tipo_anexo_cargos');
    }
}
