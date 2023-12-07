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
        Schema::create('cotizacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nro_coti')->unique();
            $table->decimal('monto_total');
            $table->date('fecha_validez');
            $table->date('fecha_realizada'); //se debe se mover a la tabla ventas
            $table->time('hora');
            $table->string('estado');
            $table->unsignedBigInteger('ci_cliente')->nullable();
            $table->unsignedBigInteger('ci_empleado')->nullable();
            $table->unsignedBigInteger('descuento')->nullable();
            $table->decimal('total_en_bolivianos')->nullable();
            $table->decimal('total_en_dolares')->nullable();
            $table->string('referencia')->nullable();
            $table->string('atencion')->nullable();
            $table->unsignedBigInteger('id_datos');
            $table->timestamps();


            //foring key con proveedores
            $table->foreign('ci_cliente')
            ->references('ci')
            ->on('clientes')
            ->onDelete('Cascade')
            ->onUpdate('Cascade');

            //foring key con proveedores
            $table->foreign('ci_empleado')
            ->references('ci')
            ->on('empleados')
            ->onDelete('Cascade')
            ->onUpdate('Cascade');

            //foring key con datos generales
            $table->foreign('id_datos')
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
        Schema::dropIfExists('cotizacions');
    }
};
