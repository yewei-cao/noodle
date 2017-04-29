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
            $table->float('distancefee');
            $table->float('maxfree');
            $table->float('freedelivery');
            $table->string('googleapi');
            $table->string('meta');
            $table->boolean('cash');
            $table->boolean('credit');
            $table->boolean('poli');
            $table->string('poliapi')->nullable();
            $table->string('dayoff');
            $table->string('starttime');
            $table->string('closetime');
            $table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();
        });
        
        Schema::create('addresses', function (Blueprint $table) {
        	$table->increments('id');
        	$table->integer('orders_id')->unsigned();
        	$table->string('address');
        	$table->string('suburb');
        	$table->string('city');
        	$table->float('fee');
        	$table->timestamp('created_at')->nullable();
        	$table->timestamp('updated_at')->nullable();
        	$table->foreign('orders_id')->references('id')->on('orders')->onDelete('cascade');
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
        	Schema::drop('addresses');
        	Schema::drop('blacklists');
    }
}
