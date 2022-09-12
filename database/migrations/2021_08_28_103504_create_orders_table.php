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
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('vendor_id');
            $table->integer('product_id');
            $table->string('order_number');
            $table->string('product_name');
            $table->string('image');
            $table->integer('qty');
            $table->string('price');
            $table->string('variation')->nullable();
            $table->string('tax')->nullable();
            $table->string('coupon_name')->nullable();
            $table->string('discount_amount')->nullable();
            $table->string('shipping_cost')->nullable();
            $table->string('order_total');
            $table->longText('order_notes')->nullable();
            $table->integer('payment_type');
            $table->string('full_name');
            $table->string('email');
            $table->string('mobile');
            $table->string('landmark')->nullable();
            $table->text('street_address');
            $table->string('pincode');
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
