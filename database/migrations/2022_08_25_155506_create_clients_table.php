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
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('N ombre del cliente');
            $table->string('telephone')->nullable()->comment('Número de teléfono contacto del cliente');
            $table->unsignedInteger('type_client_id')->comment('ID del tipo de cliente');
            $table->unsignedInteger('zone_id')->comment('ID de la zona del cliente');
            $table->string('comment')->nullable()->comment('Aclaraciones, comentarios, observaciones del o los artículos');
            $table->boolean('active')->default(false);

            $table->foreign('type_client_id')->references('id')->on('type_clients');
            $table->foreign('zone_id')->references('id')->on('zones');
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
        Schema::dropIfExists('clients');
    }
};
