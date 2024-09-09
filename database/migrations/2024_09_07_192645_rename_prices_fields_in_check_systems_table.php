<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePricesFieldsInCheckSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('check_systems', function (Blueprint $table) {
            $table->renameColumn('price', 'price_ru');
            $table->renameColumn('price_2', 'price_not_ru');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('check_systems', function (Blueprint $table) {
            $table->renameColumn('price_ru', 'price');
            $table->renameColumn('price_not_ru', 'price_2');
        });
    }
}
