<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckUniquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_uniques', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->nullable();
            $table->string('pages')->nullable();
            $table->string('wordsCount')->nullable();
            $table->string('symbolsCount')->nullable();
            $table->string('sentenceCount')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('check_uniques');
    }
}
