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
            $table->string('telephone', 8)->nullable()->comment('Número de teléfono contacto del cliente');
            $table->longText('description')->nullable()->comment('Descripción, comentarios');
            $table->unsignedInteger('type_client_id')->comment('ID del tipo de cliente');

            $table->foreign('type_client_id')->references('id')->on('type_clients');
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