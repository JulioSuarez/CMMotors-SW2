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
        Schema::create('datos_generals', function (Blueprint $table) {
            $table->id();
            $table->decimal('tipo_de_cambio')->nullable();
            $table->string('forma_pago')->nullable();
            $table->string('cheque')->nullable();
            $table->string('cuenta_bancaria')->nullable();
            $table->string('entrega')->nullable();
            $table->string('nota')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos_generals');
    }
};
