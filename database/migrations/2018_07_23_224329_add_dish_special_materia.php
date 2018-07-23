<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDishSpecialMateria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table('orderitems', function (Blueprint $table) {
    		$table->integer('selectspecial');
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table('orderitems', function (Blueprint $table) {
    		$table->dropColumn('selectspecial');
    	});
    }
}
