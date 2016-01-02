<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExceptToMaterialTalbe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->float('price')->nullable();
            $table->string('photo_thumbnail_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('photo_thumbnail_path');
        });
    }
}
