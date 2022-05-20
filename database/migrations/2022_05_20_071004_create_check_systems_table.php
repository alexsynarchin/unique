<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_systems', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->bigInteger('api_id')->unsigned()->nullable();
            $table->longText('description')->nullable();
            $table->integer('price')->unsigned()->default(0);
            $table->integer('symbols_count')->default(0);
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
        Schema::dropIfExists('check_systems');
    }
}
