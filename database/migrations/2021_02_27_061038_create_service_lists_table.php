<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicelistsTable extends Migration
{
    private $tableName1 = "services";
    private $tableName2 = "service_items";

    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create($this->tableName1, function (Blueprint $table) {
            $table->id('service_id');

            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on("clients");

            $table->unsignedBigInteger('service_catalog_id');
            $table->foreign('service_catalog_id')->references('id')->on('service_catalogs');

            $table->string('name');
            $table->string('experience');

            $table->text('description');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();

            $table->string('photo');
            $table->string('document_number');
            $table->string('document_image');

            $table->string("state");
            $table->string("city");
            $table->text("address");
            $table->string("pincode");

            $table->string('available_days');
            $table->string('available_time');
            $table->string('item_ids');
            $table->string('status')->default("Pending");

            $table->timestamps();
        });

        Schema::create($this->tableName2, function (Blueprint $table) {
            $table->id('item_id');

            // $table->unsignedBigInteger('ser_id');
            // $table->foreign('ser_id')->references('ser_id')->on($this->tableName1);

            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on("clients");

            $table->string('name');
            $table->string('description');
            $table->string('item_price');
            $table->boolean('item_status')->default(1);

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
        Schema::dropIfExists($this->tableName2);
        Schema::dropIfExists($this->tableName1);
    }
}
