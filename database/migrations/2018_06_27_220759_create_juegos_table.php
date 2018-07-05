<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuegosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juegos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('creador_id');
            $table->string('descripcion');
            $table->string('instrucciones');
            $table->string('titulo');
            $table->string('nombre_server')->unique();
            $table->string('avatar');
            $table->integer('cant_valoraciones')->default(1);
            $table->float('valoracion_promedio')->default(5.0);
            $table->date('fecha_creacion');

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
        Schema::dropIfExists('juegos');
    }
}
