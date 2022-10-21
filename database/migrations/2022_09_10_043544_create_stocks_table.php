<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('article_id')->comment('ID del articulo');
            $table->string('quantity_items')->comment('Cantidad de artículos respecto a la unidad de medida');
            $table->integer('units_for_unit')->comment('Unidades contenidas por unidad de medida');
            $table->float('buy_price')->comment('Precio individual al que fue comprado el artículo ');
            $table->float('sale_price')->comment('Precio de venta individual del articulo ');
            $table->unsignedInteger('supplier_id')->comment('ID proveedor');
            $table->unsignedInteger('measure_unit_id')->comment('ID de la unidad de medida');
            $table->string('comment')->nullable()->comment('Aclaraciones, comentarios, observaciones del o los artículos');

            $table->timestamps();
            
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('measure_unit_id')->references('id')->on('measure_units')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
};
