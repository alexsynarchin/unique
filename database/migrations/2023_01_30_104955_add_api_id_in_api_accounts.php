<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApiIdInApiAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('api_accounts', function (Blueprint $table) {
            $table->BigInteger('api_id')->unsigned();
            $table->foreign('api_id')->references('id')->on('check_apis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('api_accounts', function (Blueprint $table) {
            $table->dropColumn('api_id');
        });
    }
}
