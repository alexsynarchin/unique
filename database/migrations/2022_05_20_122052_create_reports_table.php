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
            $table->string('pages')->nullable();
            $table->string('wordsCount')->nullable();
            $table->string('symbolsCount')->nullable();
            $table->string('sentenceCount')->nullable();
            $table->string('type')->nullable();
            $table->string('email')->nullable();
            $table->json('data')->nullable();
            $table->longText('plainText')->nullable();
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
