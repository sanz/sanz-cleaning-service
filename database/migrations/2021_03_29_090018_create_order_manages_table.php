<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderManagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('orders', function (Blueprint $table) {

            // $table->id();
            $table->id('order_id');
            $table->string('order_code');

            // $table->unsignedBigInteger('ser_cat_id');
            // $table->foreign("ser_cat_id")->references("id")->on("service_catalogs");

            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('customers');

            $table->unsignedBigInteger('service_id');
            $table->foreign("service_id")->references("service_id")->on("services");

            $table->string("item_ids");
            // $table->unsignedBigInteger('item_id');
            // $table->foreign('item_id')->references('item_id')->on('user_ser_item_price');

            $table->date('booking_date');
            $table->string('address');
            $table->string('time_slot');
            $table->string('amount');
            $table->boolean('pay_status')->default(0);
            $table->string('service_status')->default("pending");

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
