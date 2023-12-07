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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id('ci');
            $table->string('nombre');
            $table->string('estado');
            $table->unsignedBigInteger('telefono');
            $table->string('foto')->nullable();
            // $table->string('firma');
            // $table->string('sello');
            $table->timestamps();
            $table->unsignedBigInteger('id_usuario')->nullable();

            $table->foreign('id_usuario')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('empleados');
    }
};
