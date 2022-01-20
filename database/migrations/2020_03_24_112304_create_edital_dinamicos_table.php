<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditalDinamicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edital_dinamicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('telas_edital_id');
            $table->timestamps();

            $table->foreign('telas_edital_id')->references('id')->on('telas_edital')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edital_dinamicos');
    }
}
