<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderitems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orders_id')->unsigned();
            $table->integer('dishes_id')->unsigned();
            $table->string('flavour');
            $table->integer('amount');
            $table->decimal('price', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamp('created_at')->nullable();
        	$table->timestamp('updated_at')->nullable();
        	$table->foreign('orders_id')->references('id')->on('orders')->onDelete('cascade');
        	$table->foreign('dishes_id')->references('id')->on('dishes')->onDelete('cascade');
        });
        
        Schema::create('material_orderitems', function (Blueprint $table) {
        	$table->increments('id');
        	$table->integer('orderitems_id')->unsigned();
        	$table->integer('material_id')->unsigned();
        	$table->string('type');
        	$table->decimal('price', 10, 2);
        	$table->foreign('orderitems_id')->references('id')->on('orderitems')->onDelete('cascade');
        	$table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orderitems');
        Schema::drop('material_orderitems');
    }
}
