<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Jugadas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jugadas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('juego_id');
            $table->integer('user_id');
            $table->integer('puntaje');
            $table->timestamp('fecha');
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
        Schema::dropIfExists('jugadas');
    }
}
