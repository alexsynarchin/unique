<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniqueOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unique_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('check_unique_id')->unsigned();
            $table->boolean('russia')->nullable();
            $table->string('url')->nullable();
            $table->string('status');
            $table->integer('sum')->unsigned()->default(0);
            $table->string('paymentType')->nullable();
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
        Schema::dropIfExists('unique_orders');
    }
}
