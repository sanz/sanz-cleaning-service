<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_catalogs', function (Blueprint $table) {
            $table->id();
            $table->string("service_name");
            $table->string("service_category");
            $table->text("service_description")->nullable(true);

            $table->string("service_image");

            $table->boolean("service_status")->default(true);
            $table->softDeletes();
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
        Schema::dropIfExists('service_catalogs');
    }
}
