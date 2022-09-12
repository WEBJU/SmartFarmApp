<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('vendor_id');
            $table->integer('cat_id');
            $table->integer('subcat_id');
            $table->integer('innersubcat_id');
            $table->string('product_name');
            $table->longText('description');
            $table->string('old_price')->nullable();
            $table->string('discounted_price')->nullable();
            $table->string('variation_price')->nullable();
            $table->string('qty')->nullable();
            $table->string('variation')->nullable();
            $table->text('slug');
            $table->integer('is_variation');
            $table->string('attribute')->nullable();
            $table->string('status')->default('1');
            $table->string('is_hot')->default('2');
            $table->integer('free_shipping');
            $table->integer('flat_rate');
            $table->integer('shipping_cost');
            $table->integer('is_return');
            $table->integer('return_days');
            $table->integer('is_featured');
            $table->string('available_stock');
            $table->string('est_shipping_days');
            $table->text('sku');
            $table->string('tax');
            $table->string('tax_type');
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
        Schema::dropIfExists('products');
    }
}
