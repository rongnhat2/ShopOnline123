<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ShipperDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipper_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipper_id');
            $table->string('telephone');
            $table->string('birthday');
            $table->string('address');
            $table->string('sex');
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
        Schema::dropIfExists('shipper_detail');
    }
}
