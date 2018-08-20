<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');		
            $table->string('description');		
            $table->string('short_description');		
            $table->string('meta_title');		
            $table->string('meta_keyword');		
            $table->string('meta_description');					
            $table->timestamps();
        });	
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
