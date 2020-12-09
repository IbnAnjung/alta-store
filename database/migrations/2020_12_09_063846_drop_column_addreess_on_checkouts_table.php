<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnAddreessOnCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->dropColumn("addreess");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->text("addreess")->after("phone");
        });
    }
}
