<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockSoldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_solds', function (Blueprint $table) {
            $table->unsignedBigInteger('u_id');
            $table->unsignedBigInteger('s_id');
            $table->dateTime('sell_date');
            $table->bigInteger('quantity')->unsigned();
        });
        
        Schema::table('stock_solds', function($table) {
            $table->primary(['u_id', 's_id', 'sell_date']);
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
        Schema::dropIfExists('stock_solds');
    }
}
