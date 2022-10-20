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
        Schema::create('type_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 10)->comment('Nombre descriptivo del tipo del tipo de cliente');
            $table->string('description')->comment('Descripción del tipo de cliente');
            $table->unsignedInteger('method_paid_id')->comment('Método de pago');

            $table->timestamps();
            
            $table->foreign('method_paid_id')->references('id')->on('method_paids')->onDelete('cascade');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_clients');
    }
};
