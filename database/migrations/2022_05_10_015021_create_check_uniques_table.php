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
            $table->string('pages')->nullable();
            $table->string('wordsCount')->nullable();
            $table->string('symbolsCount')->nullable();
            $table->string('sentenceCount')->nullable();
            $table->string('type')->nullable();
            $table->string('email')->nullable();
            $table->longText('plainText')->nullable();
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
