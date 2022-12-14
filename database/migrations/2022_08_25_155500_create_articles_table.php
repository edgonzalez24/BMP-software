<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('Nombres del articulo');
            $table->string('photo')->nullable()->comment('Ruta de la imagen representativa ');
            $table->string('comment')->nullable()->comment('Aclaraciones, comentarios, observaciones del o los artículos');
            $table->unsignedInteger('measure_unit_id')->comment('ID de la unidad de medida');
            $table->unsignedInteger('category_id')->comment('ID de la categoría');
            $table->boolean('active')->default(true)->comment('Marca al articulo como activo o inactivo ');
            
            $table->foreign('measure_unit_id')->references('id')->on('measure_units');
            $table->foreign('category_id')->references('id')->on('measure_units');
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
        Schema::dropIfExists('articles');
    }
}
