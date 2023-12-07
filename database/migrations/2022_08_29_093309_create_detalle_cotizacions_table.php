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
        Schema::create('detalle_cotizacions', function (Blueprint $table) {
            $table->id();
            // $table->text('detalles');
            $table->unsignedBigInteger('cantidad');
            $table->decimal('precio');
            $table->unsignedBigInteger('id_producto');
            $table->unsignedBigInteger('id_cotizacion');
            $table->decimal('precio_producto_unitario')->nullable();
            $table->string('tiempo_entrega')->nullable();
            $table->string('detalle_co')->nullable();
            $table->string('unidad_co')->nullable();


            //foring key con producto
            $table->foreign('id_producto')
            ->references('id')
            ->on('productos')
            ->onDelete('Cascade')
            ->onUpdate('Cascade');

            //foring key con proveedores
            $table->foreign('id_cotizacion')
            ->references('id')
            ->on('cotizacions')
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
        Schema::dropIfExists('detalle_cotizacions');
    }
};
