<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_code')->nullable();
            $table->string('user_name');
            $table->string('user_email')->unique();
            $table->string('user_mobile');
            $table->string('user_gender');
            $table->string('password');
            $table->string('user_img_url')->nullable();
            $table->string('user_state')->nullable();
            $table->string('user_city')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->integer('user_pincode')->nullable();
            $table->boolean('user_status')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('customers');
    }
}
