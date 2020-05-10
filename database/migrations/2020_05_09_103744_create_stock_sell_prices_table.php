<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockSellPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_sell_prices', function (Blueprint $table) {
            $table->unsignedBigInteger('s_id');
            $table->decimal('sell_price', 20, 4);
            $table->dateTime('sell_date');
        });

        Schema::table('stock_sell_prices', function($table) {
            $table->primary(['s_id', 'sell_date']);
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
        Schema::dropIfExists('stock_sell_prices');
    }
}
