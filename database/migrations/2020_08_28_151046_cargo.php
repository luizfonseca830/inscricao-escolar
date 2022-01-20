<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cargo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('cargos', function($table)
        {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('escolaridade_id');
            $table->string('cargo', 100);
            $table->timestamps();

            $table->foreign('escolaridade_id')->references('id')->on('escolaridade');
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
        Schema::dropIfExists('cargos');
    }
}
