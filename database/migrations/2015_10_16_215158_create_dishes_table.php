<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	
    	Schema::create('types', function (Blueprint $table) {
    		$table->increments('id');
    		$table->integer('users_id')->unsigned();
    		$table->string('name');
    		$table->integer('ranking')->nullable();
    		$table->text('description');
    		$table->timestamps();
    		$table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
    	});
    	    	
    	Schema::create('catalogues', function (Blueprint $table) {
    		$table->increments('id');
    		$table->integer('users_id')->unsigned();
    		$table->integer('type_id')->unsigned();
    		$table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
    		$table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
    		$table->string('name');
    		$table->integer('ranking')->nullable();
    		$table->text('description');
    		$table->timestamps();
    	});
    	
    	Schema::create('material_types', function (Blueprint $table) {
    		$table->increments('id');
    		$table->string('name');
    		$table->text('description');
    		$table->timestamps();
    	});
    	

    	Schema::create('materials', function (Blueprint $table) {
    		$table->increments('id');
    		$table->integer('material_type_id')->unsigned();
    		$table->string('name');
    		$table->text('description');
    		$table->float('price')->nullable();
    		$table->string('photo_thumbnail_path')->nullable();
    		$table->boolean('valid');
    		$table->string('photo_name')->nullable();
    		$table->string('photo_path')->nullable();
    		$table->foreign('material_type_id')->references('id')->on('material_types')->onDelete('cascade');
    		$table->timestamps();
    	});
    	
    	
    	Schema::create('mgroups', function (Blueprint $table) {
    		$table->increments('id');
    		$table->string('name');
    		$table->text('description');
    		$table->timestamps();
    	});
    	
    	Schema::create('material_mgroup', function (Blueprint $table) {
    		$table->integer('mgroup_id')->unsigned();
    		$table->integer('material_id')->unsigned();
    		$table->foreign('mgroup_id')->references('id')->on('mgroups')->onDelete('cascade');
    		$table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
    		$table->primary(['mgroup_id','material_id']);
    	});
    			 
        Schema::create('dishes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('mgroup_id')->unsigned();
            $table->integer('number')->unique();
            $table->integer('ranking')->nullable();
            $table->float('price');
            $table->text('description');
            $table->float('consumptionpoint');
            $table->string('photo_name')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('photo_thumbnail_path')->nullable();
            $table->boolean('valid');
            $table->timestamps();
            $table->foreign('mgroup_id')->references('id')->on('mgroups')->onDelete('cascade');
        });
        
        Schema::create('catalogue_dishes', function (Blueprint $table) {
        	$table->integer('catalogue_id')->unsigned();
        	$table->integer('dishes_id')->unsigned();
        	$table->foreign('dishes_id')->references('id')->on('dishes')->onDelete('cascade');
        	$table->foreign('catalogue_id')->references('id')->on('catalogues')->onDelete('cascade');
        	$table->primary(['catalogue_id','dishes_id']);
        });
        
        Schema::create('dishes_material', function (Blueprint $table) {
        	$table->integer('material_id')->unsigned();
        	$table->integer('dishes_id')->unsigned();
        	$table->foreign('dishes_id')->references('id')->on('dishes')->onDelete('cascade');
        	$table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
        	$table->primary(['material_id','dishes_id']);
        });
        
//         Schema::create('dish_photos', function (Blueprint $table) {
//         	$table->increments('id');
//         	$table->integer('dish_id')->unsigned();
//         	$table->string('name');
//         	$table->string('path');
//             $table->string('thumbnail_path');
//         	$table->timestamps();
//         	$table->foreign('dish_id')->references('id')->on('dishes')->onDelete('cascade');
//         });
        
        
        Schema::create('tags', function (Blueprint $table) {
        	$table->increments('id');
        	$table->string('name');
        	$table->text('description');
        	$table->timestamps();
        });
        
        
        Schema::create('tag_dish', function (Blueprint $table) {
        	$table->integer('tag_id')->unsigned();
        	$table->integer('dish_id')->unsigned();
        	$table->integer('user_id')->unsigned();
        	$table->foreign('dish_id')->references('id')->on('dishes')->onDelete('cascade');
        	$table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        	$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        	$table->primary(['user_id','dish_id','tag_id']);
        	$table->dateTime('created_at');
        });
        
        
        
//         Schema::create('material_dish', function (Blueprint $table) {
//         	$table->integer('material_id')->unsigned();
//         	$table->integer('dish_id')->unsigned();
//         	$table->foreign('dish_id')->references('id')->on('dishes')->onDelete('cascade');
//         	$table->foreign('material_id')->references('id')->on('material')->onDelete('cascade');
//         	$table->primary(['material_id','dish_id']);
//         	$table->dateTime('created_at');
//         });
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('types');
        Schema::drop('catalogues');
        Schema::drop('material_types');
        Schema::drop('materials');
        Schema::drop('mgroups');
        Schema::drop('material_mgroup');
        Schema::drop('catalogue_dishes');
        Schema::drop('dishes_material');
        Schema::drop('dishes');
//         Schema::drop('dish_photos');
        Schema::drop('tag_dish');
        Schema::drop('tags');
//         Schema::drop('material_dish');
//         Schema::drop('material');
    }
}
