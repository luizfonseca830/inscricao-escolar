<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditalDinamicoTipoAnexosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edital_dinamico_tipo_anexos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('edital_dinamico_id')->nullable();
            $table->unsignedBigInteger('cargo_id');
            $table->unsignedBigInteger('tipo_anexo_id');

            $table->foreign('edital_dinamico_id')->references('id')->on('edital_dinamicos')->onDelete('set null');
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete("cascade");;
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
        Schema::dropIfExists('edital_dinamico_tipo_anexos');
    }
}
