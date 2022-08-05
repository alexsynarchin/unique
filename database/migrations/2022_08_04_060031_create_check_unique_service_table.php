<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckUniqueServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_unique_service', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('check_unique_id');
            $table->unsignedBigInteger('service_id');
            $table->foreign('check_unique_id')->references('id')->on('check_uniques')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_unique_service');
    }
}
