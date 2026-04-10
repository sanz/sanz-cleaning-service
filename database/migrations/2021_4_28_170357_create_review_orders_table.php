<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_reviews', function (Blueprint $table) {
            $table->id("ro_id");
            $table->unsignedBigInteger("service_id");
            $table->foreign("service_id")->references("service_id")->on("services");
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("customers");

            $table->integer("response_rating");
            $table->integer("service_rating");

            $table->integer("communication_rating");
            $table->integer("price_rating");


            $table->string("title")->nullable();
            $table->longText("feedback")->nullable(true);

            $table->string("image")->nullable();

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
        Schema::dropIfExists('service_reviews');
    }
}
