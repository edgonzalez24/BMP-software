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
        Schema::create('method_paids', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('Nombre del método o madalidad de pago');
            $table->string('description')->nullable()->comment('Descripción del método o modalidad de pago');
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
        Schema::dropIfExists('method_paids');
    }
};
