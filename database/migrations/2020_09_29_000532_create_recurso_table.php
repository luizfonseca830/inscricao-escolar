<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecursoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recurso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pessoa_id');
            $table->unsignedBigInteger('avaliador_id')->nullable();
            $table->boolean('status')->nullable();
            $table->date('data_avaliado')->nullable();
            $table->string('recusar_motivo')->nullable();
            $table->string('url_anexo', '500')->nullable();
            $table->string('recurso', 500);
            $table->timestamps();

            $table->foreign('pessoa_id')->references('id')->on('pessoa');
            $table->foreign('avaliador_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recurso');
    }
}
