<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_purchases', function (Blueprint $table) {
            $table->unsignedBigInteger('u_id');
            $table->unsignedBigInteger('s_id');
            $table->dateTime('purchase_date');
            $table->bigInteger('quantity')->unsigned();
        });
        
        Schema::table('stock_purchases', function($table) {
            $table->primary(['u_id', 's_id', 'purchase_date']);
            $table->foreign('u_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('s_id')->references('id')->on('stocks')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_purchases');
    }
}
