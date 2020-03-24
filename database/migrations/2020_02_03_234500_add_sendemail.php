<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSendemail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table('orders', function (Blueprint $table) {
    		$table->boolean('sendemail');
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table('orders', function (Blueprint $table) {
    		$table->dropColumn('sendemail');
    	});
    }
}
