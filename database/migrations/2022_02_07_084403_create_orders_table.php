<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_types');
            $table->string('name');
            $table->longText('address');
            $table->string('order_id');
            $table->string('item');
            $table->string('unit_price');
            $table->string('quantity');
            $table->string('zip_code');
            $table->string('email');
            $table->string('tracking_id');
            $table->string('shipping_method');
            $table->string('shipping');
            $table->timestamp('date')->nullable();
            $table->longText('note');
            $table->string('status')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
