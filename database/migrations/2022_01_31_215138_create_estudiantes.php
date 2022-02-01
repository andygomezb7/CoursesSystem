<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudiantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('Nombre');  // Title of our blog post          
            $table->text('Telefono');   // Body of our blog post                  
            $table->text('Correo'); // user_id of our blog post author

            $table->timestamps();
        });

        Schema::create('profesores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('Nombre');  // Title of our blog post          
            $table->text('Telefono');   // Body of our blog post                  
            $table->text('Correo'); // user_id of our blog post author

            $table->timestamps();
        });

        Schema::create('materias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nombrecurso');  // Title of our blog post          
            $table->text('creditos');   // Body of our blog post                  
            $table->text('horario'); // user_id of our blog post author
            $table->unsignedBigInteger('idprofesor');
            $table->foreign('idprofesor')->references('id')->on('profesores'); // user_id of our blog post author

            $table->timestamps();
        });

        Schema::create('asignacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idmateria');
            $table->foreign('idmateria')->references('id')->on('materias');  // Title of our blog post          
            $table->unsignedBigInteger('idestudiante');
            $table->foreign('idestudiante')->references('id')->on('estudiantes');  // Title of our blog post          
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
        Schema::dropIfExists('estudiantes');
        Schema::dropIfExists('profesores');
        Schema::dropIfExists('materias');
        Schema::dropIfExists('asignacion');
    }
}
