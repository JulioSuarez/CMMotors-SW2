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
        Schema::create('detalle_membresias', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->decimal('precio', 8, 2);
            $table->unsignedBigInteger('memb');
            $table->unsignedBigInteger('id_venta');
            //foring key con membresias
            $table->foreign('memb')
                ->references('id')
                ->on('membresias')
                ->onUpdate('Cascade');

            //foring key con ventas
            $table->foreign('id_venta')
                ->references('id')
                ->on('ventas')
                ->onDelete('Cascade')
                ->onUpdate('Cascade');


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
        Schema::dropIfExists('detalle_membresias');
    }
};
