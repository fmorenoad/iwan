<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->string('ticket');
            $table->unsignedBigInteger('enterprise_id');
            $table->unsignedBigInteger('plot_id');
            $table->unsignedBigInteger('farmer_id');
            $table->unsignedBigInteger('kg_income');
            $table->boolean('end_of_plot');
            $table->dateTime('plot_departure_date', $precision = 0);
            $table->dateTime('entry_date', $precision = 0);
            $table->string('ppu', $length = 6);
            $table->string('dispatch_guide_id');
            $table->string('kg_dispatch_guide');
            $table->integer('season');
            $table->softDeletes();
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
        Schema::dropIfExists('receipts');
    }
}
