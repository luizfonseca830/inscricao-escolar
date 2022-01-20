<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Termos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('termos', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedBigInteger('pessoa_id');
            $table->boolean('aceito_dados');
            $table->foreign('pessoa_id')->references('id')->on('pessoa');
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
        Schema::dropIfExists('termos');
    }
}
