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
    	Schema::table('shops', function (Blueprint $table) {
    		$table->boolean('coupon');
    		$table->boolean('email_coupon');
    		$table->float('coupon_value');
    		$table->float('coupon_condition');
    		$table->integer('coupon_max')->nullable();
    	});
    	
        Schema::create('coupons', function (Blueprint $table) {
        	$table->increments('id');
        	$table->integer('orders_id')->unsigned()->nullable();;
        	$table->string('code')->unique();
        	$table->string('title');
        	$table->decimal('value', 10, 2);
        	$table->string('photo_path')->nullable();
        	$table->string('email');
        	$table->boolean('used');
        	$table->timestamp('used_time')->nullable();
        	$table->timestamp('expired_time')->nullable();
        	$table->timestamp('created_at')->nullable();
        	$table->timestamp('updated_at')->nullable();
        	$table->foreign('orders_id')->references('id')->on('orders')->onDelete('cascade');
        });
        
        
//         Schema::create('coupons_orders', function (Blueprint $table) {
//         	$table->integer('coupons_id')->unsigned();
//         	$table->integer('orders_id')->unsigned();
//         	$table->foreign('coupons_id')->references('id')->on('coupons')->onDelete('cascade');
//         	$table->foreign('orders_id')->references('id')->on('orders')->onDelete('cascade');
//         	$table->primary(['coupons_id','orders_id']);
//         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table('shops', function (Blueprint $table) {
    		//
    		$table->dropColumn('coupon');
    		$table->dropColumn('email_coupon');
    		$table->dropColumn('coupon_value');
    		$table->dropColumn('coupon_condition');
    		$table->dropColumn('coupon_max');
    	});
//     	Schema::drop('coupons_orders');
    	Schema::drop('coupons');
    }
}
