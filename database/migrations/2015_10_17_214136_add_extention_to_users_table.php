<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtentionToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
        	$table->string('mobilephone');
        	$table->string('phone');
        	$table->integer('comsumptionAmount');
        });
        
        Schema::create('assumption_record', function (Blueprint $table) {
        	$table->increments('id');
        	$table->integer('user_id')->unsigned();;
        	$table->integer('point');
        	$table->dateTime('created_at');
        	$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        
        Schema::create('area', function (Blueprint $table) {
        	$table->increments('id');
        	$table->string('name');
        	$table->string('label');
        });
        
        Schema::create('userAddress', function (Blueprint $table) {
        	$table->increments('id');
        	$table->integer('user_id')->unsigned();;
        	$table->integer('area_id')->unsigned();;
        	$table->string('address');
        	$table->foreign('area_id')->references('id')->on('area')->onDelete('cascade');
        	$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        	$table->timestamps();
        });
    }

    /**
     * 
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        	$table->dropColumn('mobilephone');
        	$table->dropColumn('telephone');
        	$table->dropColumn('telephone');
        });
        
        	Schema::drop('assumption_record');
        	Schema::drop('userAddress');
        	Schema::drop('area');
    }
}
