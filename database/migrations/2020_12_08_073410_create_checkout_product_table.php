<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout_product', function (Blueprint $table) {
            $table->bigInteger("checkout_id")->unsigned();
            $table->bigInteger("product_id")->unsigned();
            $table->integer("qty")->unsigned();
            $table->integer("price")->unsigned();
            $table->decimal("weight", 4, 2);
            $table->string("description");
            $table->timestamps();

            $table->primary(["checkout_id", "product_id"]);
            $table->foreign("checkout_id")->references("id")->on("checkouts");
            $table->foreign("product_id")->references("id")->on("products");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkout_product');
    }
}
