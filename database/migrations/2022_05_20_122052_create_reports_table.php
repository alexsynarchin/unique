<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->nullable();
            $table->BigInteger('check_unique_id')->unsigned();
            $table->foreign('check_unique_id')->references('id')->on('check_uniques')->onDelete('cascade');
            $table->BigInteger('system_id')->unsigned();
            $table->foreign('system_id')->references('id')->on('check_systems')->onDelete('cascade');
            $table->json('data')->nullable();
            $table->boolean('result')->default(false);
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
        Schema::dropIfExists('reports');
    }
}
