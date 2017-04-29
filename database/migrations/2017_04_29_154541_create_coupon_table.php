<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coupon', function (Blueprint $table) {
        	$table->increments('id');
        	$table->string('code');
        	$table->string('title');
        	$table->decimal('value', 10, 2);
        	$table->string('email');
        	$table->boolean('used');
        	$table->timestamp('used_time')->nullable();
        	$table->timestamp('created_at')->nullable();
        	$table->timestamp('updated_at')->nullable();
        });
        
        Schema::create('dishes_material', function (Blueprint $table) {
        	$table->integer('material_id')->unsigned();
        	$table->integer('dishes_id')->unsigned();
        	$table->foreign('dishes_id')->references('id')->on('dishes')->onDelete('cascade');
        	$table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
        	$table->primary(['material_id','dishes_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::drop('ordericoupontems');
    }
}
