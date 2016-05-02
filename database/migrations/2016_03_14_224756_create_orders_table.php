<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	
        Schema::create('orders', function (Blueprint $table) {
        	$table->increments('id');
        	$table->integer('ordernumber')->unsigned()->unique();
        	
        	$table->decimal('total', 10, 2);
        	$table->float('totaldue')->nullable();
        	$table->boolean('status');
        	
        	$table->string('name');
        	$table->string('email');
        	$table->string('phonenumber');
        	
        	$table->boolean('paymentflag');
        	$table->integer('staff_id')->nullable();
        	$table->integer('paymentmethod_id')->nullable();
        	$table->dateTime('paymenttime');
        	$table->dateTime('shiptime');
        	$table->string('shipmethod')->nullable();
        	$table->integer('useraddress_id')->nullable();
        	$table->text('comment')->nullable();
        	$table->text('message')->nullable();
        	$table->timestamps();
        });
        
        Schema::create('dishes_orders', function (Blueprint $table) {
        	$table->integer('orders_id')->unsigned();
        	$table->integer('dishes_id')->unsigned();
        	$table->integer('amount');
        	$table->decimal('price', 10, 2);
        	$table->decimal('total', 10, 2);
        	$table->foreign('dishes_id')->references('id')->on('dishes')->onDelete('cascade');
        	$table->foreign('orders_id')->references('id')->on('orders')->onDelete('cascade');
        	$table->primary(['dishes_id','orders_id']);
        });
        
        	
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dishes_orders');
        Schema::drop('orders');
        
        
    }
}
