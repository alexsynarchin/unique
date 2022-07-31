<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewrites', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('name')->nullable();
            $table->unsignedSmallInteger('status')->default(0);
            $table->date('date')->nullable();
            $table->integer('price')->default(0);
            $table->string('filename')->nullable();
            $table->longText('plain_text')->nullable();
            $table->json('text_params')->nullable();
            $table->BigInteger('promo_id')->unsigned()->nullable();
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
        Schema::dropIfExists('rewrites');
    }
}
