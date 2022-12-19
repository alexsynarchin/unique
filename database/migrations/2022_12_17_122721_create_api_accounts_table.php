<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('key')->nullable();
            $table->string('password')->nullable();
            $table->integer('balance')->unsigned()->default(0);
            $table->bigInteger('menuindex')->unsigned()->default(0);
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
        Schema::dropIfExists('api_accounts');
    }
}
