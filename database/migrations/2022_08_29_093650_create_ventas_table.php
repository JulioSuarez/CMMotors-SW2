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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->decimal('monto_total');
            $table->date('fecha');
            $table->time('hora');
            $table->unsignedBigInteger('descuento')->nullable();
            $table->decimal('total_en_bolivianos')->nullable();
            $table->decimal('total_en_dolares')->nullable();
            $table->unsignedBigInteger('ci_cliente');
            $table->unsignedBigInteger('ci_empleado');
            $table->unsignedBigInteger('id_datos_generales');
            $table->string('id_venta');
            $table->string('nro_factura')->default('0');

            //foring key con datos generales
            $table->foreign('id_datos_generales')
                ->references('id')
                ->on('datos_generals')
                ->onDelete('Cascade')
                ->onUpdate('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
};
