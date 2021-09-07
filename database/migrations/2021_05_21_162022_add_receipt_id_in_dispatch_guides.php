<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReceiptIdInDispatchGuides extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dispatch_guides', function (Blueprint $table) {
            $table->unsignedBigInteger('receipt_id')->nullable();

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
        Schema::table('dispatch_guides', function (Blueprint $table) {
            $table->dropColumn('receipt_id');
        });
    }
}
