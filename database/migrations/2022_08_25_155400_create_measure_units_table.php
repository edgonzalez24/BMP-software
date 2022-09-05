<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeasureUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measure_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('measure_units')->comment('Nombre de la unidad de medida');
            $table->string('descripción')->comment('Descripción, comentarios sobre la unidad de medida');
            $table->boolean('active')->default(true)->comment('Marca a la unidad de medida como activo o inactivo ');
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
        Schema::dropIfExists('measure_units');
    }
}
