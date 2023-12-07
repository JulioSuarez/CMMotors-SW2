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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->String('cod_producto')->unique(); //nunable 
            $table->String('cod_oem');    //codigo oem ->unique()
            $table->String('nombre');
            $table->string('marca')->nullable();
            $table->string('procedencia')->nullable();
            $table->string('origen')->nullable();
            $table->Integer('cantidad')->default(0);
            $table->Integer('cant_minima')->default(1);
            $table->decimal('precio_venta_con_factura')->default(0);
            $table->decimal('precio_venta_sin_factura')->default(0);
            $table->decimal('precio_compra')->default(0);
            $table->string('foto')->nullable();
            // $table->date('fecha_expiracion')->nullable();
            $table->string('tienda'); //hacer una clase is es que habria mas atributos
            $table->string('unidad');   //piezas, .....
            $table->string('estado');
            $table->string('estante');
            $table->string('id_tugerente'); //id_producto
            $table->unsignedBigInteger('id_proveedor');
            $table->timestamps();

            //foring key con proveedores
            $table->foreign('id_proveedor')
            ->references('id')
            ->on('proveedors')
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
        Schema::dropIfExists('productos');
    }
};
