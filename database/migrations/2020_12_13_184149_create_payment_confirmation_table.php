<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentConfirmationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_confirmation', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number', 15)->nullable();
            $table->string('payment_method', 15)->nullable();
            $table->date("payment_date");
            $table->integer("payment_total");
            $table->string("to_account", 25);
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
        Schema::dropIfExists('payment_confirmation');
    }
}
