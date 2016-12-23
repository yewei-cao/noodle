<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('address');
            $table->string('phone');
            $table->float('distancelevel1');
            $table->float('distancelevel2');
            $table->float('freedelivery');
            $table->string('meta');
            $table->string('cash');
            $table->string('credit');
            $table->string('poli');
            $table->string('dayoff');
            $table->string('starttime');
            $table->string('closetime');
            $table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();
        });
        
        Schema::create('blacklists', function (Blueprint $table) {
        	$table->increments('id');
        	$table->string('ip');
        	$table->string('reason')->nullable();
        	$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        	Schema::drop('shops');
        	Schema::drop('blacklists');
    }
}
