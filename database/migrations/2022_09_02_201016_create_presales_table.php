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
        Schema::create('presales', function (Blueprint $table) {
            $table->increments('id');
            $table->float('total_paid')->nullable()->comment('Total de monto pagado de esta venta');
            $table->float('total_pending')->nullable()->comment('Total de monto pendiente de pago de esta venta');
            $table->float('total_detail')->nullable()->comment('Total del detalle de la venta');
            $table->boolean('paid')->comment('Marca como pagada la preventa')->default(false);
            $table->boolean('added')->comment('Marca como agregado a la preventa')->default(false);
            $table->unsignedInteger('dispatch_id')->nullable()->comment('Estado del despacho')->default(false);
            $table->unsignedInteger('client_id')->comment('ID del cliente');
            $table->unsignedInteger('user_presale_id')->comment('ID usuario de preventa ');
            $table->unsignedInteger('user_dispatch_id')->nullable()->comment('ID de usuario que despacha la preventa');
            $table->unsignedInteger('method_paid_id')->comment('ID de del método de pago, éste por defecto será el del tipo de cliente');

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('user_presale_id')->references('id')->on('users');
            $table->foreign('user_dispatch_id')->references('id')->on('users');
            $table->foreign('method_paid_id')->references('id')->on('method_paids');
            $table->foreign('dispatch_id')->references('id')->on('dispatches');
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
        Schema::dropIfExists('presales');
    }
};
