<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockPurchasePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_purchase_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('s_id');
            $table->decimal('purchasing_price', 20, 4);
            $table->dateTime('purchase_date');
        });

        Schema::table('stock_purchase_prices', function($table) {
            // $table->primary(['s_id', 'purchase_date']);
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
        Schema::dropIfExists('stock_purchase_prices');
    }
}
