<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_anexo_id');
            $table->unsignedBigInteger('edital_dinamico_id');

            $table->foreign('tipo_anexo_id')->references('id')->on('tipo_anexo');
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
        Schema::dropIfExists('progress');
    }
}
