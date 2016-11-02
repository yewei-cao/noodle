<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label')->nullable();
            $table->timestamps();
        });
        
        Schema::create('permissions', function (Blueprint $table) {
        	$table->increments('id');
        	$table->string('name');
        	$table->string('label')->nullable();
        	$table->timestamps();
        });
        	
        Schema::create('permission_role', function (Blueprint $table) {
        	$table->integer('permission_id')->unsigned();
        	$table->integer('role_id')->unsigned();
        	$table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        	$table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        	$table->primary(['permission_id','role_id']);
        	});
        
        Schema::create('role_users', function (Blueprint $table) {
        	$table->integer('users_id')->unsigned();
        	$table->integer('role_id')->unsigned();
        	$table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        	$table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        	$table->primary(['users_id','role_id']);
        	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::drop('role_user');
    	Schema::drop('permission_role');
    	Schema::drop('permissions');
    	Schema::drop('roles');
    }
}
