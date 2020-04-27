<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDetailsToShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shops', function (Blueprint $table) {
        	$table->text('openhours');
        	$table->string('showtext');
        	$table->boolean('popup');
        	$table->string('popuptext');
        	$table->boolean('printer');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shops', function (Blueprint $table) {
        	$table->dropColumn('openhours');
        	$table->dropColumn('showtext');
        	$table->dropColumn('popup');
        	$table->dropColumn('popuptext');
        	$table->dropColumn('printer');
            //
        });
    }
}
