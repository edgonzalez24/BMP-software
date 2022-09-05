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
        Schema::create('presale_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('total_articles')->comment('Cantidad de artículos pedidos en preventas');
            $table->boolean('dischargued')->comment('Marca al articulo como pagado o pendiente de pago');
            $table->float('total')->comment('Monto total por artículo prevendido');
            $table->unsignedInteger('article_id')->comment('ID de articles');
            $table->unsignedInteger('presale_id')->comment('ID de la preventa - factura');

            $table->foreign('article_id')->references('id')->on('articles');
            $table->foreign('presale_id')->references('id')->on('presales');
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
        Schema::dropIfExists('presale_details');
    }
};
