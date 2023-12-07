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
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_proveedor');
            $table->string('proveedor_direccion')->nullable();
            $table->string('proveedor_telefono')->nullable();
            $table->string('proveedor_correo')->nullable();
            $table->string('estado')->default('Habilitado');
            $table->string('nombre_proveedor_contacto')->nullable();
            $table->string('nit')->unique();
            $table->string('tipo')->nullable();//poriamos adicionar una descripcion
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
        Schema::dropIfExists('proveedors');
    }
};
