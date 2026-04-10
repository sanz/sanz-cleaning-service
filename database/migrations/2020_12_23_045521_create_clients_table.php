<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("client_code");
            $table->string('client_name');
            $table->string('client_email')->unique();
            $table->string('client_mobile');
            $table->string('password');
            $table->string('client_gender');
            $table->string('client_photo_url')->default("images/default-img/user.png");
            $table->string('client_status')->default('Active');
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
        Schema::dropIfExists('clients');
    }
}
