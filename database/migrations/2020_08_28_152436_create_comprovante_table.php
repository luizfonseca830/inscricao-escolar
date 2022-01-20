<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprovanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //
    public function up()
    {
        Schema::create('comprovante', function (Blueprint $table) {
            $table->id();
            $table->string('comprovante', 255)->nullable();
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
        Schema::dropIfExists('comprovante');
    }
}
