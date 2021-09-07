<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSamplingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samplings', function (Blueprint $table) {
            $table->id();
            $table->float('gross_sample', 3, 1);
            $table->float('net_sample', 3, 1);
            $table->float('ingress_humidity', 3, 1);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('receipt_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('receipt_id')
                ->references('id')
                ->on('receipts')
                ->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('samplings');
    }
}
