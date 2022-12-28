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
        Schema::create('pase_diarios', function (Blueprint $table) {
            $table->id();
            $table->string('Identificador');
            $table->string('Patente');
            $table->date('Fecha');
            $table->integer('Categoria');
            $table->integer('Deuda');
            $table->integer('DeudaTag');
            $table->integer('Estado')->nullable();
            $table->integer('TipoPatente')->nullable();
            $table->datetime('FechaInformadoPST')->nullable();
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
        Schema::dropIfExists('pase_diarios');
    }
};
