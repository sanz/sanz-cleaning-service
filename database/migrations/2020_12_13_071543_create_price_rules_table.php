<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('service_prices', function (Blueprint $table) {
            $table->id('pr_id');
            $table->unsignedBigInteger('service_catalog_id');
            $table->foreign('service_catalog_id')->references('id')->on('service_catalogs');
            $table->string('visit_charge')->default(10);
            $table->string('service_charge')->default(2);
            $table->boolean('pr_status')->default(1);
            $table->boolean('pr_d_status')->default(0);
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
        Schema::dropIfExists('service_prices');
    }
}
