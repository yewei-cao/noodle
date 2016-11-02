<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrdersToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_users', function (Blueprint $table) {
        $table->integer('orders_id')->unsigned();
        $table->integer('users_id')->unsigned();
        $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('orders_id')->references('id')->on('orders')->onDelete('cascade');
        $table->primary(['orders_id','users_id']);
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders_users');
    }
}
