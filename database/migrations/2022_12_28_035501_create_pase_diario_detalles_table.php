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
        Schema::create('pase_diario_detalles', function (Blueprint $table) {
            $table->id();
            $table->string('Identificador');
            $table->string('Patente');
            $table->date('Fecha');
            $table->integer('ClaseCategoria');
            $table->string('ClaseCategoriaDescripcion');
            $table->integer('Categoria');
            $table->string('CategoriaDescripcion');
            $table->integer('Deuda');
            $table->integer('DeudaTag');
            $table->integer('NumCorrCA')->unique();
            $table->integer('Estado')->nullable();
            $table->integer('pase_diario_id')->nullable();
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
        Schema::dropIfExists('pase_diario_detalles');
    }
};
